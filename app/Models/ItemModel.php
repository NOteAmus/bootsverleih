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
        'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'type' => 'required|in_list[boot,liegeplatz]',
        'name' => 'required|max_length[255]',
        'price_per_day' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['encodeFeatures'];
    protected $beforeUpdate = ['encodeFeatures'];
    protected $afterFind = ['decodeFeatures'];

    /**
     * Get all active boats
     */
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

    /**
     * Get all active berths (Liegeplätze)
     */
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

    /**
     * Get boats by category
     */
    public function getBoatsByCategory(string $category): array
    {
        return $this->where('type', 'boot')
            ->where('category', $category)
            ->where('is_active', true)
            ->findAll();
    }

    /**
     * Get berths by row
     */
    public function getBerthsByRow(string $row): array
    {
        return $this->where('type', 'liegeplatz')
            ->where('row', $row)
            ->where('is_active', true)
            ->orderBy('position', 'ASC')
            ->findAll();
    }

    /**
     * Check availability of an item for a date range
     */
    public function checkAvailability(int $itemId, string $startDate, string $endDate): bool
    {
        $reservationModel = new \App\Models\ReservationModel();
        
        // Check if there are any overlapping reservations
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

    /**
     * Get available items for a date range
     */
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

    /**
     * Encode features array to JSON before insert/update
     */
    protected function encodeFeatures(array $data): array
    {
        if (isset($data['data']['features']) && is_array($data['data']['features'])) {
            $data['data']['features'] = json_encode($data['data']['features']);
        }
        
        return $data;
    }

    /**
     * Decode features JSON to array after find
     */
    protected function decodeFeatures(array $data): array
    {
        if (isset($data['data'])) {
            // Multiple rows
            if (is_array($data['data'])) {
                foreach ($data['data'] as &$row) {
                    if (isset($row['features']) && is_string($row['features'])) {
                        $row['features'] = json_decode($row['features'], true) ?? [];
                    }
                }
            }
        } elseif (isset($data['features']) && is_string($data['features'])) {
            // Single row
            $data['features'] = json_decode($data['features'], true) ?? [];
        }
        
        return $data;
    }
}
