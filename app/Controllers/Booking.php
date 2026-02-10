<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReservationModel;
use App\Models\ItemModel;

class Booking extends Controller
{
    public function index(): string
    {
        $itemModel = new ItemModel();
        $boatPositionModel = new \App\Models\BoatPositionModel();

        $data['slots'] = $itemModel->getBerths(); // Liegeplätze aus Datenbank laden
        $data['boats'] = $itemModel->getBoats(); // Boote aus Datenbank laden
        $data['marina_info'] = $this->getMarinaInfo();

        // Lade Schiffspositionen aus der Datenbank
        $boatPositions = $boatPositionModel->getMarinaBoatPositions();

        // Wenn keine Positionen vorhanden sind, initialisiere Default-Positionen
        if (empty($boatPositions)) {
            $boatPositionModel->initializeDefaultPositions();
            $boatPositions = $boatPositionModel->getMarinaBoatPositions();
        }

        $data['boat_positions'] = $boatPositions;

        // User-Rolle für Admin-Check übergeben
        $session = session();
        $user = $session->get('user');
        $data['user_role'] = $user['role'] ?? 'guest';
        $data['is_admin'] = ($data['user_role'] === 'admin');

        // Wetterdaten laden (wie in Home Controller)
        try {
            $weatherService = new \App\Libraries\Weather();
            $data['weather'] = $weatherService->getCurrentWeather();
        } catch (\Throwable $e) {
            // Bei Fehler null verwenden (View zeigt Fallback-Werte)
            $data['weather'] = null;
        }

        return view('booking-view', $data);
    }

    private function getMarinaInfo()
    {
        return [
            'name' => 'Yachthafen Plau am See',
            'slogan' => 'Premium Liegeplatzverwaltung & Bootsverleih',
            'subtitle' => 'Digitale Exzellenz am Plauer See',
            'description' => 'Buchen Sie direkt online Ihren Liegeplatz oder mieten Sie ein Boot für Ihren perfekten Tag auf dem Wasser. Einfach, schnell und transparent.',
            'contact' => [
                'phone' => '+49 123 456789',
                'email' => 'info@yachthafen-plau.de',
                'address' => 'Hafenstraße 1, 19395 Plau am See'
            ]
        ];
    }

    private function getPremiumSlots()
    {
        $slots = [];

        // Premium Reihe A - direkt am Steg
        for ($i = 1; $i <= 6; $i++) {
            $slots[] = [
                'id' => 'A' . $i,
                'number' => 'A' . $i,
                'row' => 'A',
                'position' => $i,
                'available' => $i % 3 !== 0,
                'type' => 'premium',
                'price_per_day' => 45.00,
                'max_length' => 15,
                'features' => ['Strom', 'Wasser', 'WLAN', 'Premium-Steg']
            ];
        }

        // Komfort Reihe B
        for ($i = 1; $i <= 8; $i++) {
            $slots[] = [
                'id' => 'B' . $i,
                'number' => 'B' . $i,
                'row' => 'B',
                'position' => $i,
                'available' => $i % 4 !== 0,
                'type' => 'comfort',
                'price_per_day' => 35.00,
                'max_length' => 12,
                'features' => ['Strom', 'Wasser', 'WLAN']
            ];
        }

        // Standard Reihe C
        for ($i = 1; $i <= 10; $i++) {
            $slots[] = [
                'id' => 'C' . $i,
                'number' => 'C' . $i,
                'row' => 'C',
                'position' => $i,
                'available' => $i % 5 !== 0,
                'type' => 'standard',
                'price_per_day' => 25.00,
                'max_length' => 10,
                'features' => ['Strom', 'Wasser']
            ];
        }

        // Economy Reihe D
        for ($i = 1; $i <= 8; $i++) {
            $slots[] = [
                'id' => 'D' . $i,
                'number' => 'D' . $i,
                'row' => 'D',
                'position' => $i,
                'available' => $i % 2 !== 0,
                'type' => 'economy',
                'price_per_day' => 18.00,
                'max_length' => 8,
                'features' => ['Strom']
            ];
        }

        return $slots;
    }

    private function getPremiumBoats()
    {
        return [
            [
                'id' => 1,
                'name' => 'Bavaria Cruiser 37',
                'type' => 'Segelyacht',
                'category' => 'premium',
                'length' => 11.3,
                'year' => 2023,
                'capacity' => 8,
                'price_per_day' => 350,
                'image' => 'bavaria-cruiser.jpg',
                'features' => ['Kajüt', 'Küche', 'WC', 'GPS', 'Autopilot']
            ],
            [
                'id' => 2,
                'name' => 'Hanse 388',
                'type' => 'Segelyacht',
                'category' => 'premium',
                'length' => 11.4,
                'year' => 2022,
                'capacity' => 6,
                'price_per_day' => 320,
                'image' => 'hanse-388.jpg',
                'features' => ['2 Kabinen', 'Kombüse', 'Dusche', 'Elektrowinde']
            ],
            [
                'id' => 3,
                'name' => 'Jeanneau Sun Odyssey 349',
                'type' => 'Segelyacht',
                'category' => 'comfort',
                'length' => 10.3,
                'year' => 2021,
                'capacity' => 6,
                'price_per_day' => 280,
                'image' => 'jeanneau-349.jpg',
                'features' => ['Großraum', 'Kühlschrank', 'Heizung', 'Badeleiter']
            ],
            [
                'id' => 4,
                'name' => 'Quicksilver Activ 675',
                'type' => 'Motorboot',
                'category' => 'comfort',
                'length' => 6.75,
                'year' => 2023,
                'capacity' => 8,
                'price_per_day' => 220,
                'image' => 'quicksilver-675.jpg',
                'features' => ['Sonnenliege', 'Badeplattform', 'Kühlbox', 'USB-Anschluss']
            ],
            [
                'id' => 5,
                'name' => 'Bayliner VR6',
                'type' => 'Motorboot',
                'category' => 'standard',
                'length' => 6.1,
                'year' => 2022,
                'capacity' => 6,
                'price_per_day' => 180,
                'image' => 'bayliner-vr6.jpg',
                'features' => ['Ski-Torpedo', 'Badeleiter', 'Sportlenkung', 'Stereoanlage']
            ],
            [
                'id' => 6,
                'name' => 'Zodiac Cadet 310',
                'type' => 'Schlauchboot',
                'category' => 'economy',
                'length' => 3.1,
                'year' => 2023,
                'capacity' => 4,
                'price_per_day' => 90,
                'image' => 'zodiac-310.jpg',
                'features' => ['Leicht', 'Wendig', 'Einfache Bedienung', 'Transportabel']
            ]
        ];
    }

    public function getAvailability()
    {
        $date = $this->request->getGet('date');
        $type = $this->request->getGet('type');

        if ($type === 'boat') {
            $availability = $this->getPremiumBoats();
        } else {
            $availability = $this->getPremiumSlots();
        }

        return $this->response->setJSON($availability);
    }

    public function makeBoatReservation()
    {
        $data = $this->request->getJSON(true); // true = als Array zurückgeben
        $reservationModel = new ReservationModel();
        $itemModel = new ItemModel();
        
        // Get user from session
        $session = session();
        $userId = $session->get('user')['id'] ?? null;

        // Validate input
        if (!isset($data['item_id']) || !isset($data['start_date']) || !isset($data['end_date'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Fehlende Pflichtfelder'
            ]);
        }

        // Convert item_id to integer
        $itemId = (int) $data['item_id'];

        $paymentMethod = $data['payment_method'] ?? 'paypal';
        $allowedPaymentMethods = ['paypal', 'card', 'cash'];
        if (!in_array($paymentMethod, $allowedPaymentMethods, true)) {
            $paymentMethod = 'paypal';
        }

        // Check availability
        if (!$reservationModel->isItemAvailable($itemId, $data['start_date'], $data['end_date'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Boot ist im gewählten Zeitraum nicht verfügbar'
            ]);
        }

        // Get boat details (DB first, otherwise demo list for the showcase)
        $boat = $itemModel->find($itemId);

        if (!$boat || ($boat['type'] ?? '') !== 'boot') {
            // fallback: demo boats for non-DB showcase
            $demoBoat = null;
            foreach ($this->getPremiumBoats() as $b) {
                if ((int)($b['id'] ?? 0) === $itemId) {
                    $demoBoat = $b;
                    break;
                }
            }

            if ($demoBoat) {
                // normalize demo boat to expected fields
                $boat = [
                    'id' => $demoBoat['id'] ?? $itemId,
                    'name' => $demoBoat['name'] ?? 'Demo Boot',
                    'boat_type' => $demoBoat['type'] ?? 'Demo',
                    'type' => 'boot',
                    'price_per_day' => $demoBoat['price_per_day'] ?? 0,
                    'length' => $demoBoat['length'] ?? null,
                    'capacity' => $demoBoat['capacity'] ?? null,
                ];
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Boot nicht gefunden'
                ]);
            }
        }

        // Calculate days and price
        $startDate = new \DateTime($data['start_date']);
        $endDate = new \DateTime($data['end_date']);
        $days = $startDate->diff($endDate)->days + 1;
        $boatPrice = $days * $boat['price_per_day'];
        $serviceFee = 25.00;
        $insurance = 35.00;
        $totalAmount = $boatPrice + $serviceFee + $insurance;

        // Create reservation with pending status
        $reservationData = [
            'user_id' => $userId,
            'reservation_number' => $reservationModel->generateReservationNumber('boot'),
            'reservation_type' => 'boot',
            'item_id' => $itemId,
            'customer_name' => $data['customer_name'] ?? '',
            'customer_email' => $data['customer_email'] ?? '',
            'customer_phone' => $data['customer_phone'] ?? null,
            'boat_name' => $boat['name'],
            'boat_type' => $boat['boat_type'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'days' => $days,
            'price_per_day' => $boat['price_per_day'],
            'boat_price' => $boatPrice,
            'service_fee' => $serviceFee,
            'insurance' => $insurance,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
            'additional_equipment' => $data['additional_equipment'] ?? null,
            'experience_level' => $data['experience_level'] ?? null,
        ];

        $reservationId = $reservationModel->insert($reservationData);
        
        if ($reservationId) {
            $redirectUrl = $paymentMethod === 'cash'
                ? base_url('my-bookings?payment=cash&reservation=' . $reservationData['reservation_number'])
                : base_url('payment/' . $reservationId);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Reservierung erstellt. Weiterleitung zur Zahlung...',
                'reservation_id' => $reservationId,
                'reservation_number' => $reservationData['reservation_number'],
                'redirect_url' => $redirectUrl
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Fehler beim Erstellen der Reservierung'
        ]);
    }

    public function makeSlotReservation()
    {
        $data = $this->request->getJSON(true); // true = als Array zurückgeben
        $reservationModel = new ReservationModel();
        $itemModel = new ItemModel();
        
        // Get user from session
        $session = session();
        $userId = $session->get('user')['id'] ?? null;

        // Validate input - now expects slot_ids array
        if (!isset($data['slot_ids']) || !isset($data['start_date']) || !isset($data['end_date'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Fehlende Pflichtfelder'
            ]);
        }

        // Get slot IDs array
        $slotIds = is_array($data['slot_ids']) ? $data['slot_ids'] : [$data['slot_ids']];
        
        if (empty($slotIds)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Bitte wählen Sie mindestens einen Liegeplatz aus'
            ]);
        }

        $paymentMethod = $data['payment_method'] ?? 'paypal';
        $allowedPaymentMethods = ['paypal', 'card', 'cash'];
        if (!in_array($paymentMethod, $allowedPaymentMethods, true)) {
            $paymentMethod = 'paypal';
        }

        // Get first slot for calculation (could be enhanced to support multiple prices)
        $itemId = (int) $slotIds[0];

        // Check availability for all slots
        foreach ($slotIds as $slotId) {
            if (!$reservationModel->isItemAvailable((int)$slotId, $data['start_date'], $data['end_date'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Einer oder mehrere Liegeplätze sind im gewählten Zeitraum nicht verfügbar'
                ]);
            }
        }

        // Get berth details
        $berth = $itemModel->find($itemId);
        if (!$berth || $berth['type'] !== 'liegeplatz') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Liegeplatz nicht gefunden'
            ]);
        }

        // Calculate days and price
        $startDate = new \DateTime($data['start_date']);
        $endDate = new \DateTime($data['end_date']);
        $days = $startDate->diff($endDate)->days + 1;
        
        // Calculate total for all selected slots
        $berthPrice = $days * $berth['price_per_day'] * count($slotIds);
        $serviceFee = 10.00; // Lower service fee for berths
        $totalAmount = $berthPrice + $serviceFee;

        // Create reservation with pending status
        $reservationData = [
            'user_id' => $userId,
            'reservation_number' => $reservationModel->generateReservationNumber('liegeplatz'),
            'reservation_type' => 'liegeplatz',
            'item_id' => $itemId,
            'customer_name' => $data['customer_name'] ?? '',
            'customer_email' => $data['customer_email'] ?? '',
            'customer_phone' => $data['customer_phone'] ?? null,
            'boat_name' => 'Liegeplatz ' . $berth['slot_number'] . (count($slotIds) > 1 ? ' (+' . (count($slotIds) - 1) . ' weitere)' : ''),
            'boat_type' => 'Liegeplatz',
            'boat_length' => $data['boat_length'] ?? null,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'days' => $days,
            'price_per_day' => $berth['price_per_day'],
            'boat_price' => $berthPrice,
            'service_fee' => $serviceFee,
            'insurance' => 0.00, // No insurance for berths
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
            'special_requests' => $data['special_requests'] ?? null,
        ];

        $reservationId = $reservationModel->insert($reservationData);
        
        if ($reservationId) {
            // Store all slot IDs for this reservation (for future multi-slot support)
            foreach ($slotIds as $slotId) {
                // Could add to a reservation_slots table here
            }
            
            $redirectUrl = $paymentMethod === 'cash'
                ? base_url('my-bookings?payment=cash&reservation=' . $reservationData['reservation_number'])
                : base_url('payment/' . $reservationId);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Reservierung erstellt. Weiterleitung zur Zahlung...',
                'reservation_id' => $reservationId,
                'reservation_number' => $reservationData['reservation_number'],
                'redirect_url' => $redirectUrl
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Fehler beim Erstellen der Reservierung'
        ]);
    }

    /**
     * Get available items by type
     */
    public function getAvailableItems()
    {
        $type = $this->request->getGet('type');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!$type || !in_array($type, ['boot', 'liegeplatz'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ungültiger Typ'
            ]);
        }

        $itemModel = new ItemModel();

        if ($startDate && $endDate) {
            $items = $itemModel->getAvailableItems($type, $startDate, $endDate);
        } else {
            $items = $type === 'boot' ? $itemModel->getBoats() : $itemModel->getBerths();
        }

        return $this->response->setJSON([
            'success' => true,
            'items' => $items
        ]);
    }
    /**
     * Boot-Verschieben Reiter
     */
    public function boatMoving()
    {
        $itemModel = new ItemModel();
        $boatPositionModel = new BoatPositionModel();

        $data['boats'] = $itemModel->getBoats();
        $data['slots'] = $itemModel->getBerths();
        $data['boatPositions'] = $boatPositionModel->getMarinaBoatPositions();

        return view('boat-moving-view', $data);
    }

    /**
     * Save boat positions via API
     */
    public function saveBoatPositions()
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $positions = $this->request->getJSON(true);

        if (!is_array($positions)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid data format'
            ]);
        }

        $boatPositionModel = new BoatPositionModel();

        try {
            $success = $boatPositionModel->saveBoatPositions($positions);

            if ($success) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Boot-Positionen gespeichert',
                    'saved_count' => count($positions)
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Save boat positions failed: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Internal server error'
            ]);
        }
    }

    /**
     * Move boat to slot
     */
    public function moveBoatToSlot()
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $data = $this->request->getJSON(true);
        $boatPositionId = $data['boat_position_id'] ?? null;
        $slotId = $data['slot_id'] ?? null;

        if (!$boatPositionId || !$slotId) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Missing required parameters'
            ]);
        }

        $boatPositionModel = new BoatPositionModel();

        try {
            $success = $boatPositionModel->moveToSlot($boatPositionId, $slotId);

            if ($success) {
                // Get updated position
                $position = $boatPositionModel->find($boatPositionId);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Boot wurde auf Liegeplatz verschoben',
                    'position' => $position
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Konnte Boot nicht verschieben'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Move boat to slot failed: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Internal server error'
            ]);
        }
    }

    /**
     * Move boat to water
     */
    public function moveBoatToWater()
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $data = $this->request->getJSON(true);
        $boatPositionId = $data['boat_position_id'] ?? null;

        if (!$boatPositionId) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Missing boat position ID'
            ]);
        }

        $boatPositionModel = new BoatPositionModel();

        try {
            $success = $boatPositionModel->moveToWater($boatPositionId);

            if ($success) {
                $position = $boatPositionModel->find($boatPositionId);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Boot wurde ins Wasser verschoben',
                    'position' => $position
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Konnte Boot nicht verschieben'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Move boat to water failed: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Internal server error'
            ]);
        }
    }

    /**
     * Get boat positions for marina
     */
    public function getBoatPositions()
    {
        $boatPositionModel = new BoatPositionModel();
        $positions = $boatPositionModel->getMarinaBoatPositions();

        return $this->response->setJSON([
            'success' => true,
            'positions' => $positions
        ]);
    }

    /**
     * Move ships - Update boat positions in grid
     */
    public function moveShips()
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $data = $this->request->getJSON(true);

        if (!isset($data['movements']) || !is_array($data['movements'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid data format. Expected movements array.'
            ]);
        }

        $movements = $data['movements'];

        if (empty($movements)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keine Bewegungen zum Speichern'
            ]);
        }

        $boatPositionModel = new \App\Models\BoatPositionModel();

        try {
            $success = $boatPositionModel->updateBoatPositions($movements);

            if ($success) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => count($movements) . ' Schiffe erfolgreich verschoben',
                    'count' => count($movements)
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern der Positionen'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Move ships failed: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Serverfehler beim Speichern'
            ]);
        }
    }
}