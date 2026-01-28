<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'reservation_number',
        'reservation_type',
        'item_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'boat_name',
        'boat_type',
        'start_date',
        'end_date',
        'days',
        'price_per_day',
        'boat_price',
        'service_fee',
        'insurance',
        'total_amount',
        'payment_method',
        'payment_status',
        'additional_equipment',
        'experience_level',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'reservation_number' => 'required|max_length[50]',
        'customer_name' => 'required|max_length[255]',
        'customer_email' => 'required|valid_email|max_length[255]',
        'boat_name' => 'required|max_length[255]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'total_amount' => 'required|decimal',
    ];

    protected $validationMessages = [
        'customer_email' => [
            'valid_email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function generateReservationNumber(string $type = 'boot'): string
    {
        $prefix = $type === 'liegeplatz' ? 'BERTH-' : 'BOAT-';

        do {
            $number = $prefix . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        } while ($this->where('reservation_number', $number)->first());

        return $number;
    }

    public function isItemAvailable(int $itemId, string $startDate, string $endDate): bool
    {
        $overlapping = $this->where('item_id', $itemId)
            ->where('payment_status !=', 'cancelled')
            ->groupStart()
            ->where('start_date <=', $endDate)
            ->where('end_date >=', $startDate)
            ->groupEnd()
            ->countAllResults();

        return $overlapping === 0;
    }

    // ... restliche Methoden bleiben gleich
}