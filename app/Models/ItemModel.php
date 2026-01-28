<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'type',
        'name',
        'description',
        'category',
        'boat_type',
        'length',
        'year',
        'capacity',
        'slot_number',
        'row',
        'position',
        'max_boat_length',
        'price_per_day',
        'features',
        'image',
        'image_url',
        'is_active',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'type' => 'required|in_list[boot,liegeplatz]',
        'name' => 'required|max_length[255]',
        'price_per_day' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert = ['encodeFeatures', 'setDefaultStatus'];
    protected $beforeUpdate = ['encodeFeatures'];
    protected $afterFind = ['decodeFeatures'];

    protected function setDefaultStatus(array $data): array
    {
        if (!isset($data['data']['status'])) {
            $data['data']['status'] = 'available';
        }
        return $data;
    }

    public function getBoatsForGrid(): array
    {
        $boats = $this->where('type', 'boot')
            ->where('is_active', true)
            ->orderBy('category', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        return array_map(function($boat) {
            return [
                'id' => $boat['id'],
                'name' => $boat['name'],
                'boat_type' => $boat['boat_type'] ?? 'Unbekannt',
                'category' => $boat['category'] ?? 'standard',
                'length' => $boat['length'] ?? 0,
                'price_per_day' => $boat['price_per_day'] ?? 0,
                'image_url' => $this->getBoatImageUrl($boat)
            ];
        }, $boats);
    }

    private function getBoatImageUrl(array $boat): string
    {
        if (!empty($boat['image_url'])) {
            return $boat['image_url'];
        }
        if (!empty($boat['image'])) {
            return base_url($boat['image']);
        }
        return 'https://images.unsplash.com/photo-1505620391904-6ec12a40193e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
    }

    public function getBerthsForGrid(): array
    {
        $berths = $this->where('type', 'liegeplatz')
            ->where('is_active', true)
            ->orderBy('row', 'ASC')
            ->orderBy('position', 'ASC')
            ->findAll();

        if (empty($berths)) {
            return $this->generateDemoGridSlots();
        }

        $gridSlots = [];
        foreach ($berths as $berth) {
            $gridSlots[] = $this->formatBerthForGrid($berth);
        }

        return $gridSlots;
    }

    private function formatBerthForGrid(array $berth): array
    {
        return [
            'id' => $berth['id'],
            'slot_number' => $berth['slot_number'] ?? '',
            'row' => $berth['row'] ?? 'A',
            'col' => $berth['position'] ?? 1,
            'status' => $berth['status'] ?? 'available',
            'boatName' => $this->getOccupyingBoatName($berth['id']),
            'category' => $berth['category'] ?? 'standard',
            'price_per_day' => $berth['price_per_day'] ?? 0,
            'max_length' => $berth['max_boat_length'] ?? 10,
            'position' => $berth['position'] ?? 1
        ];
    }

    private function getOccupyingBoatName(int $berthId): ?string
    {
        $reservationModel = new \App\Models\ReservationModel();

        $reservation = $reservationModel->where('item_id', $berthId)
            ->where('payment_status', 'paid')
            ->where('end_date >=', date('Y-m-d'))
            ->orderBy('created_at', 'DESC')
            ->first();

        return $reservation['boat_name'] ?? null;
    }

    private function generateDemoGridSlots(): array
    {
        $gridSlots = [];
        $rows = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($rows as $row) {
            for ($col = 1; $col <= 8; $col++) {
                $id = $row . $col;

                $isOccupied = rand(0, 10) < 2;
                $isBooked = rand(0, 10) < 3;

                $status = $isOccupied ? 'occupied' : ($isBooked ? 'booked' : 'available');
                $boatName = ($isOccupied || $isBooked) ? 'Boot ' . rand(1, 100) : null;

                $gridSlots[] = [
                    'id' => $id,
                    'slot_number' => $id,
                    'row' => $row,
                    'col' => $col,
                    'status' => $status,
                    'boatName' => $boatName,
                    'category' => $this->getSlotCategory($row),
                    'price_per_day' => $this->getSlotPrice($row),
                    'max_length' => $this->getSlotMaxLength($row),
                    'position' => $col
                ];
            }
        }

        return $gridSlots;
    }

    private function getSlotCategory(string $row): string
    {
        $categories = [
            'A' => 'premium',
            'B' => 'comfort',
            'C' => 'standard',
            'D' => 'standard',
            'E' => 'economy',
            'F' => 'economy'
        ];

        return $categories[$row] ?? 'standard';
    }

    private function getSlotPrice(string $row): float
    {
        $prices = [
            'A' => 45.00,
            'B' => 35.00,
            'C' => 25.00,
            'D' => 25.00,
            'E' => 18.00,
            'F' => 18.00
        ];

        return $prices[$row] ?? 20.00;
    }

    private function getSlotMaxLength(string $row): int
    {
        $lengths = [
            'A' => 15,
            'B' => 12,
            'C' => 10,
            'D' => 10,
            'E' => 8,
            'F' => 8
        ];

        return $lengths[$row] ?? 10;
    }

    public function getBoatsInWater(): array
    {
        $boats = $this->getBoatsForGrid();
        $boatsInWater = [];

        foreach ($boats as $boat) {
            $reservationModel = new \App\Models\ReservationModel();
            $activeReservation = $reservationModel->where('item_id', $boat['id'])
                ->where('payment_status', 'paid')
                ->where('end_date >=', date('Y-m-d'))
                ->first();

            if (!$activeReservation) {
                $boatsInWater[] = [
                    'id' => $boat['id'],
                    'name' => $boat['name'],
                    'type' => $boat['boat_type'],
                    'category' => $boat['category'],
                    'length' => $boat['length'],
                    'top' => rand(200, 600),
                    'left' => rand(5, 75)
                ];
            }
        }

        return $boatsInWater;
    }

    public function updateBerthStatus($berthId, $status, $boatName = null): bool
    {
        $data = ['status' => $status];
        return $this->update($berthId, $data);
    }

    public function resetAllBookings(): bool
    {
        return $this->set(['status' => 'available'])
            ->where('type', 'liegeplatz')
            ->update();
    }

    public function simulateRandomBooking(): array
    {
        $availableBerths = $this->where('type', 'liegeplatz')
            ->where('status', 'available')
            ->findAll();

        $boats = $this->getBoatsInWater();

        if (empty($availableBerths) || empty($boats)) {
            return ['success' => false, 'message' => 'Keine verfügbaren Plätze oder Boote'];
        }

        $randomBerth = $availableBerths[array_rand($availableBerths)];
        $randomBoat = $boats[array_rand($boats)];

        $this->update($randomBerth['id'], ['status' => 'booked']);

        return [
            'success' => true,
            'berth_id' => $randomBerth['id'],
            'boat_name' => $randomBoat['name'],
            'message' => "Zufällige Buchung: {$randomBoat['name']} auf Platz {$randomBerth['id']}"
        ];
    }

    public function getBerthByGridPosition($row, $col): ?array
    {
        return $this->where('type', 'liegeplatz')
            ->where('row', $row)
            ->where('position', $col)
            ->first();
    }

    // Existing methods remain the same...

    public function getBoats(bool $activeOnly = true): array
    {
        $builder = $this->where('type', 'boot');

        if ($activeOnly) {
            $builder->where('is_active', true);
        }

        return $builder->orderBy('category', 'ASC')
            ->orderBy('price_per_day', 'DESC')
            ->findAll();
    }

    public function getBerths(bool $activeOnly = true): array
    {
        $builder = $this->where('type', 'liegeplatz');

        if ($activeOnly) {
            $builder->where('is_active', true);
        }

        return $builder->orderBy('row', 'ASC')
            ->orderBy('position', 'ASC')
            ->findAll();
    }

    public function getBoatsByCategory(string $category): array
    {
        return $this->where('type', 'boot')
            ->where('category', $category)
            ->where('is_active', true)
            ->findAll();
    }

    public function getBerthsByRow(string $row): array
    {
        return $this->where('type', 'liegeplatz')
            ->where('row', $row)
            ->where('is_active', true)
            ->orderBy('position', 'ASC')
            ->findAll();
    }

    public function checkAvailability(int $itemId, string $startDate, string $endDate): bool
    {
        $reservationModel = new \App\Models\ReservationModel();

        $overlapping = $reservationModel
            ->where('item_id', $itemId)
            ->where('payment_status !=', 'cancelled')
            ->groupStart()
            ->where('start_date <=', $endDate)
            ->where('end_date >=', $startDate)
            ->groupEnd()
            ->countAllResults();

        return $overlapping === 0;
    }

    public function getAvailableItems(string $type, string $startDate, string $endDate): array
    {
        $allItems = $type === 'boot' ? $this->getBoats() : $this->getBerths();
        $availableItems = [];

        foreach ($allItems as $item) {
            if ($this->checkAvailability($item['id'], $startDate, $endDate)) {
                $availableItems[] = $item;
            }
        }

        return $availableItems;
    }

    protected function encodeFeatures(array $data): array
    {
        if (isset($data['data']['features']) && is_array($data['data']['features'])) {
            $data['data']['features'] = json_encode($data['data']['features']);
        }

        return $data;
    }

    protected function decodeFeatures(array $data): array
    {
        if (isset($data['data'])) {
            if (is_array($data['data'])) {
                foreach ($data['data'] as &$row) {
                    if (isset($row['features']) && is_string($row['features'])) {
                        $row['features'] = json_decode($row['features'], true) ?? [];
                    }
                }
            }
        } elseif (isset($data['features']) && is_string($data['features'])) {
            $data['features'] = json_decode($data['features'], true) ?? [];
        }

        return $data;
    }
}