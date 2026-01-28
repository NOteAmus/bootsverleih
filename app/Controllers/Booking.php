<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\ReservationModel;

class Booking extends BaseController
{
    public function index(): string
    {
        $itemModel = new ItemModel();

        $data = [
            'title' => 'Yachthafen Plau am See - Premium Liegeplätze & Bootsverleih',
            'slots' => $itemModel->getBerthsForGrid(), // NEUE Methode für Vue.js Raster
            'boats' => $itemModel->getBoatsInWater(),  // NEUE Methode für Boote im See
            'boats_list' => $itemModel->getBoatsForGrid(), // Für die Bootsliste im Bootsverleih-Tab
            'marina_info' => $this->getMarinaInfo(),
            'weather' => $this->getWeatherData() ?? null
        ];

        return view('booking-view', $data);
    }

    private function getMarinaInfo()
    {
        return [
            'name' => 'Yachthafen Plau am See',
            'slogan' => 'Premium Liegeplatzverwaltung & Bootsverleih',
            'subtitle' => 'Interaktive Liegeplatzbuchung',
            'description' => 'Ziehen Sie Boote auf das Raster, um Plätze zu buchen. Einfach und visuell!',
            'contact' => [
                'phone' => '+49 38735 12345',
                'email' => 'info@yachthafen-plau.de',
                'address' => 'Hafenstraße 1, 19395 Plau am See'
            ]
        ];
    }

    private function getWeatherData()
    {
        // Falls du Wetterdaten integrieren möchtest, hier die Logik
        return null;
    }

    public function bookSlot()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $itemModel = new ItemModel();
        $reservationModel = new ReservationModel();

        $data = $this->request->getJSON(true);

        // Validierung
        $validation = \Config\Services::validation();
        $validation->setRules([
            'slot_id' => 'required',
            'boat_id' => 'required',
            'customer_name' => 'required|max_length[255]',
            'customer_email' => 'required|valid_email|max_length[255]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date'
        ]);

        if (!$validation->run($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        try {
            // Slot- und Boot-Daten abrufen
            $slot = $itemModel->find($data['slot_id']);
            $boat = $itemModel->find($data['boat_id']);

            if (!$slot || !$boat) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Slot oder Boot nicht gefunden'
                ]);
            }

            // Verfügbarkeit prüfen
            if (!$reservationModel->isItemAvailable($slot['id'], $data['start_date'], $data['end_date'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Der gewählte Platz ist im angegebenen Zeitraum nicht verfügbar'
                ]);
            }

            // Tagesberechnung
            $startDate = new \DateTime($data['start_date']);
            $endDate = new \DateTime($data['end_date']);
            $days = $startDate->diff($endDate)->days + 1;

            // Preisberechnung
            $slotPrice = $days * ($slot['price_per_day'] ?? 0);
            $serviceFee = 10.00;
            $totalAmount = $slotPrice + $serviceFee;

            // Reservierung erstellen
            $reservationData = [
                'reservation_number' => $reservationModel->generateReservationNumber('liegeplatz'),
                'reservation_type' => 'liegeplatz',
                'item_id' => $slot['id'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'boat_name' => $boat['name'],
                'boat_type' => $boat['boat_type'] ?? 'Boot',
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'days' => $days,
                'price_per_day' => $slot['price_per_day'] ?? 0,
                'boat_price' => $slotPrice,
                'service_fee' => $serviceFee,
                'insurance' => 0.00,
                'total_amount' => $totalAmount,
                'payment_method' => $data['payment_method'] ?? 'paypal',
                'payment_status' => 'pending',
                'notes' => $data['notes'] ?? null
            ];

            // User-ID aus Session falls vorhanden
            $session = session();
            if ($session->has('user_id')) {
                $reservationData['user_id'] = $session->get('user_id');
            }

            $reservationId = $reservationModel->insert($reservationData);

            if ($reservationId) {
                // Slot-Status aktualisieren
                $itemModel->updateBerthStatus($slot['id'], 'booked', $boat['name']);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Buchung erfolgreich erstellt',
                    'booking_id' => $reservationId,
                    'reservation_number' => $reservationData['reservation_number']
                ]);
            }

        } catch (\Exception $e) {
            log_message('error', 'Booking error: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ein Fehler ist aufgetreten: ' . $e->getMessage()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Fehler bei der Buchung'
        ]);
    }

    public function simulateBooking()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $itemModel = new ItemModel();
        $result = $itemModel->simulateRandomBooking();

        return $this->response->setJSON($result);
    }

    public function resetBookings()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $itemModel = new ItemModel();
        $success = $itemModel->resetAllBookings();

        return $this->response->setJSON([
            'success' => $success,
            'message' => $success ? 'Alle Buchungen wurden zurückgesetzt' : 'Fehler beim Zurücksetzen'
        ]);
    }

    public function checkAvailability()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $itemModel = new ItemModel();
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $type = $this->request->getGet('type', 'liegeplatz');

        $items = $itemModel->getAvailableItems($type, $startDate, $endDate);

        return $this->response->setJSON([
            'success' => true,
            'items' => $items
        ]);
    }

    public function getAllBookings()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $reservationModel = new ReservationModel();
        $bookings = $reservationModel->orderBy('created_at', 'DESC')->findAll();

        return $this->response->setJSON([
            'success' => true,
            'bookings' => $bookings
        ]);
    }
}