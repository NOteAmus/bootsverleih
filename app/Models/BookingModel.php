<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['slot_id', 'boat_id', 'customer_name', 'customer_email', 'date', 'duration', 'status'];

    public function getAvailableSlots()
    {
        // Beispiel-Daten - in der Praxis aus der Datenbank
        return [
            ['id' => 1, 'number' => 'A1', 'available' => true],
            ['id' => 2, 'number' => 'A2', 'available' => false],
            ['id' => 3, 'number' => 'A3', 'available' => true],
            ['id' => 4, 'number' => 'B1', 'available' => true],
            ['id' => 5, 'number' => 'B2', 'available' => true],
            ['id' => 6, 'number' => 'B3', 'available' => false],
            ['id' => 7, 'number' => 'C1', 'available' => true],
            ['id' => 8, 'number' => 'C2', 'available' => true],
        ];
    }

    public function getAvailableBoats()
    {
        // Beispiel-Daten - in der Praxis aus der Datenbank
        return [
            ['id' => 1, 'name' => 'Seefalke', 'type' => 'Segelboot', 'length' => 8, 'price_per_day' => 120],
            ['id' => 2, 'name' => 'Wassermann', 'type' => 'Motorboot', 'length' => 6, 'price_per_day' => 150],
            ['id' => 3, 'name' => 'Neptun', 'type' => 'Yacht', 'length' => 12, 'price_per_day' => 300],
            ['id' => 4, 'name' => 'Poseidon', 'type' => 'Katamaran', 'length' => 10, 'price_per_day' => 250],
        ];
    }

    public function getAvailability($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        // Hier würde die echte Verfügbarkeitsprüfung stattfinden
        $slots = $this->getAvailableSlots();

        return ['slots' => $slots];
    }

    public function createReservation($data)
    {
        // Hier würde die echte Reservierung in der Datenbank gespeichert werden
        return true; // Simuliert erfolgreiche Reservierung
    }

    public function updateSlot($reservationId, $newSlotId)
    {
        // Hier würde die echte Aktualisierung in der Datenbank stattfinden
        return true; // Simuliert erfolgreiches Update
    }
}