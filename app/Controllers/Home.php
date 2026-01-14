<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Load current weather via Weather library (Open-Meteo)
        try {
            $weatherService = new \App\Libraries\Weather();
            $weather = $weatherService->getCurrentWeather();
        } catch (\Throwable $e) {
            // On error, fallback to null (view will show fallback values)
            $weather = null;
        }

        return view('welcome_message', ['weather' => $weather]);
    }

    public function payment(): string
    {
        return view('payment-view');
    }

    public function processPayment()
    {
        $reservationModel = new \App\Models\ReservationModel();

        // Daten aus POST holen
        $boatName = $this->request->getPost('boat');
        $customerName = $this->request->getPost('name');
        $customerEmail = $this->request->getPost('email');
        $customerPhone = $this->request->getPost('phone');
        $startDate = $this->request->getPost('start');
        $endDate = $this->request->getPost('end');
        $pricePerDay = $this->request->getPost('price');
        $experienceLevel = $this->request->getPost('experience');
        $additionalEquipment = $this->request->getPost('equipment');
        $paymentMethod = $this->request->getPost('payment_method');

        // Tage berechnen
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $days = $start->diff($end)->days;
        if ($days < 1) $days = 1;

        // Preise berechnen
        $boatPrice = $pricePerDay * $days;
        $serviceFee = 25;
        $insurance = 35;
        $totalAmount = $boatPrice + $serviceFee + $insurance;

        // Reservierungsnummer generieren
        $reservationNumber = $reservationModel->generateReservationNumber();

        // User ID aus Session holen
        $session = session();
        $userId = $session->get('user')['id'] ?? null;

        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sie müssen eingeloggt sein, um eine Buchung vorzunehmen.',
            ]);
        }

        // Daten in Datenbank speichern
        $data = [
            'user_id' => $userId,
            'reservation_number' => $reservationNumber,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'boat_name' => $boatName,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'days' => $days,
            'price_per_day' => $pricePerDay,
            'boat_price' => $boatPrice,
            'service_fee' => $serviceFee,
            'insurance' => $insurance,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod ?? 'paypal',
            'payment_status' => 'paid',
            'experience_level' => $experienceLevel,
            'additional_equipment' => $additionalEquipment,
        ];

        try {
            $reservationModel->insert($data);
            
            // Erfolg zurückgeben
            return $this->response->setJSON([
                'success' => true,
                'reservation_number' => $reservationNumber,
                'total_amount' => $totalAmount,
            ]);
        } catch (\Exception $e) {
            // Fehler zurückgeben
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Fehler beim Speichern der Reservierung: ' . $e->getMessage(),
            ]);
        }
    }

    public function myBookings(): string
    {
        // Prüfen ob User eingeloggt ist
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/login')->with('error', 'Bitte loggen Sie sich ein, um Ihre Buchungen zu sehen.');
        }

        $userId = $session->get('user')['id'];
        $reservationModel = new \App\Models\ReservationModel();
        
        // Nur Buchungen des eingeloggten Users laden
        $bookings = $reservationModel->getUserReservations($userId);

        return view('my-bookings', [
            'bookings' => $bookings,
            'user' => $session->get('user')
        ]);
    }

    public function allBookings(): string
    {
        // Wird durch Filter geschützt - nur Admin/Worker
        $session = session();
        $reservationModel = new \App\Models\ReservationModel();
        
        // Alle Buchungen mit User-Info laden
        $bookings = $reservationModel->getAllReservationsWithUser();

        return view('all-bookings', [
            'bookings' => $bookings,
            'user' => $session->get('user')
        ]);
    }

    public function cancelBooking()
    {
        // Wird durch Filter geschützt - nur Admin/Worker
        if (!$this->request->is('post')) {
            return redirect()->to('/admin/bookings');
        }

        $bookingId = $this->request->getPost('booking_id');
        
        if (!$bookingId) {
            return redirect()->to('/admin/bookings')->with('error', 'Keine Buchungs-ID angegeben.');
        }

        $reservationModel = new \App\Models\ReservationModel();
        
        if ($reservationModel->cancelReservation($bookingId)) {
            return redirect()->to('/admin/bookings')->with('success', 'Buchung erfolgreich storniert.');
        } else {
            return redirect()->to('/admin/bookings')->with('error', 'Fehler beim Stornieren der Buchung.');
        }
    }
}
