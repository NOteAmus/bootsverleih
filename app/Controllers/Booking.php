<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Booking extends Controller
{
    public function index(): string
    {
        $data['slots'] = $this->getPremiumSlots();
        $data['boats'] = $this->getPremiumBoats();
        $data['marina_info'] = $this->getMarinaInfo();

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
        $data = $this->request->getPost();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Boot erfolgreich reserviert',
            'reservation_number' => 'BOAT-' . rand(1000, 9999)
        ]);
    }

    public function makeSlotReservation()
    {
        $data = $this->request->getPost();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Liegeplatz erfolgreich reserviert',
            'reservation_number' => 'SLOT-' . rand(1000, 9999)
        ]);
    }
}