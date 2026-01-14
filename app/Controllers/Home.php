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

    public function payment($reservationId = null): string
    {
        if (!$reservationId) {
            return redirect()->to('/booking')->with('error', 'Keine Reservierung gefunden');
        }

        $reservationModel = new \App\Models\ReservationModel();
        $reservation = $reservationModel->find($reservationId);

        if (!$reservation) {
            return redirect()->to('/booking')->with('error', 'Reservierung nicht gefunden');
        }

        if ($reservation['payment_status'] === 'paid') {
            return redirect()->to('/my-bookings')->with('info', 'Diese Reservierung wurde bereits bezahlt');
        }

        return view('payment-view', ['reservation' => $reservation]);
    }

    public function processPayment()
    {
        $reservationModel = new \App\Models\ReservationModel();

        // Reservierungs-ID aus POST holen
        $reservationId = $this->request->getPost('reservation_id');
        $paymentMethod = $this->request->getPost('payment_method');

        if (!$reservationId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keine Reservierungs-ID angegeben'
            ]);
        }

        // Reservierung laden
        $reservation = $reservationModel->find($reservationId);

        if (!$reservation) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Reservierung nicht gefunden'
            ]);
        }

        if ($reservation['payment_status'] === 'paid') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Diese Reservierung wurde bereits bezahlt'
            ]);
        }

        // Zahlungsstatus aktualisieren
        $updateData = [
            'payment_status' => 'paid',
            'payment_method' => $paymentMethod
        ];

        if ($reservationModel->update($reservationId, $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Zahlung erfolgreich',
                'reservation_number' => $reservation['reservation_number'],
                'reservation_type' => $reservation['reservation_type']
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Fehler beim Aktualisieren der Reservierung'
        ]);
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
