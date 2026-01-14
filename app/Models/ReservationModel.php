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

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
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

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Generate unique reservation number
     */
    public function generateReservationNumber(): string
    {
        do {
            $number = 'BOAT-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        } while ($this->where('reservation_number', $number)->first());

        return $number;
    }

    /**
     * Get all reservations for a specific customer
     */
    public function getCustomerReservations(string $email): array
    {
        return $this->where('customer_email', $email)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get all reservations for a specific user (by user ID)
     */
    public function getUserReservations(int $userId): array
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get reservation by reservation number
     */
    public function getByReservationNumber(string $reservationNumber): ?array
    {
        return $this->where('reservation_number', $reservationNumber)->first();
    }

    /**
     * Get all reservations with user info (for admin/worker)
     */
    public function getAllReservationsWithUser(): array
    {
        return $this->select('reservations.*, users.vorname, users.nachname, users.email as user_email')
            ->join('users', 'users.id = reservations.user_id', 'left')
            ->orderBy('reservations.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Cancel/Stornieren a reservation
     */
    public function cancelReservation(int $id): bool
    {
        return $this->update($id, ['payment_status' => 'cancelled']);
    }
}
