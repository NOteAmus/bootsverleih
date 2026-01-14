<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        // Boote hinzufügen
        $boats = [
            [
                'type' => 'boot',
                'name' => 'Bavaria Cruiser 37',
                'description' => 'Moderne Segelyacht mit hohem Komfort und ausgezeichneten Segeleigenschaften',
                'category' => 'premium',
                'boat_type' => 'Segelyacht',
                'length' => 11.30,
                'year' => 2023,
                'capacity' => 8,
                'price_per_day' => 350.00,
                'features' => json_encode(['Kajüt', 'Küche', 'WC', 'GPS', 'Autopilot']),
                'image' => 'bavaria-cruiser.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'boot',
                'name' => 'Hanse 388',
                'description' => 'Sportliche Segelyacht mit innovativer Technik',
                'category' => 'premium',
                'boat_type' => 'Segelyacht',
                'length' => 11.40,
                'year' => 2022,
                'capacity' => 6,
                'price_per_day' => 320.00,
                'features' => json_encode(['2 Kabinen', 'Kombüse', 'Dusche', 'Elektrowinde']),
                'image' => 'hanse-388.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'boot',
                'name' => 'Jeanneau Sun Odyssey 349',
                'description' => 'Vielseitige Fahrtenyacht für komfortables Segeln',
                'category' => 'comfort',
                'boat_type' => 'Segelyacht',
                'length' => 10.30,
                'year' => 2021,
                'capacity' => 6,
                'price_per_day' => 280.00,
                'features' => json_encode(['Großraum', 'Kühlschrank', 'Heizung', 'Badeleiter']),
                'image' => 'jeanneau-349.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'boot',
                'name' => 'Quicksilver Activ 675',
                'description' => 'Sportliches Motorboot für Wassersport und Ausflüge',
                'category' => 'comfort',
                'boat_type' => 'Motorboot',
                'length' => 6.75,
                'year' => 2023,
                'capacity' => 8,
                'price_per_day' => 220.00,
                'features' => json_encode(['Sonnenliege', 'Badeplattform', 'Kühlbox', 'USB-Anschluss']),
                'image' => 'quicksilver-675.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'boot',
                'name' => 'Bayliner VR6',
                'description' => 'Vielseitiges Bowrider-Motorboot',
                'category' => 'standard',
                'boat_type' => 'Motorboot',
                'length' => 6.10,
                'year' => 2022,
                'capacity' => 6,
                'price_per_day' => 180.00,
                'features' => json_encode(['Ski-Torpedo', 'Badeleiter', 'Sportlenkung', 'Stereoanlage']),
                'image' => 'bayliner-vr6.jpg',
                'is_active' => true,
            ],
            [
                'type' => 'boot',
                'name' => 'Zodiac Cadet 310',
                'description' => 'Wendiges Schlauchboot für kleine Ausflüge',
                'category' => 'economy',
                'boat_type' => 'Schlauchboot',
                'length' => 3.10,
                'year' => 2023,
                'capacity' => 4,
                'price_per_day' => 90.00,
                'features' => json_encode(['Leicht', 'Wendig', 'Einfache Bedienung', 'Transportabel']),
                'image' => 'zodiac-310.jpg',
                'is_active' => true,
            ],
        ];

        // Liegeplätze hinzufügen
        $berths = [];

        // Premium Reihe A - direkt am Steg
        for ($i = 1; $i <= 6; $i++) {
            $berths[] = [
                'type' => 'liegeplatz',
                'name' => 'Premium Liegeplatz A' . $i,
                'description' => 'Premium Liegeplatz direkt am Hauptsteg mit allen Annehmlichkeiten',
                'category' => 'premium',
                'slot_number' => 'A' . $i,
                'row' => 'A',
                'position' => $i,
                'max_boat_length' => 15.00,
                'price_per_day' => 45.00,
                'features' => json_encode(['Strom', 'Wasser', 'WLAN', 'Premium-Steg']),
                'is_active' => true,
            ];
        }

        // Komfort Reihe B
        for ($i = 1; $i <= 8; $i++) {
            $berths[] = [
                'type' => 'liegeplatz',
                'name' => 'Komfort Liegeplatz B' . $i,
                'description' => 'Komfortabler Liegeplatz mit guter Ausstattung',
                'category' => 'comfort',
                'slot_number' => 'B' . $i,
                'row' => 'B',
                'position' => $i,
                'max_boat_length' => 12.00,
                'price_per_day' => 35.00,
                'features' => json_encode(['Strom', 'Wasser', 'WLAN']),
                'is_active' => true,
            ];
        }

        // Standard Reihe C
        for ($i = 1; $i <= 10; $i++) {
            $berths[] = [
                'type' => 'liegeplatz',
                'name' => 'Standard Liegeplatz C' . $i,
                'description' => 'Standard Liegeplatz mit Basis-Ausstattung',
                'category' => 'standard',
                'slot_number' => 'C' . $i,
                'row' => 'C',
                'position' => $i,
                'max_boat_length' => 10.00,
                'price_per_day' => 25.00,
                'features' => json_encode(['Strom', 'Wasser']),
                'is_active' => true,
            ];
        }

        // Economy Reihe D
        for ($i = 1; $i <= 8; $i++) {
            $berths[] = [
                'type' => 'liegeplatz',
                'name' => 'Economy Liegeplatz D' . $i,
                'description' => 'Günstiger Liegeplatz für kleinere Boote',
                'category' => 'economy',
                'slot_number' => 'D' . $i,
                'row' => 'D',
                'position' => $i,
                'max_boat_length' => 8.00,
                'price_per_day' => 18.00,
                'features' => json_encode(['Strom']),
                'is_active' => true,
            ];
        }

        // Insert all items
        $builder = $this->db->table('items');
        
        foreach ($boats as $boat) {
            $boat['created_at'] = date('Y-m-d H:i:s');
            $boat['updated_at'] = date('Y-m-d H:i:s');
            $builder->insert($boat);
        }

        foreach ($berths as $berth) {
            $berth['created_at'] = date('Y-m-d H:i:s');
            $berth['updated_at'] = date('Y-m-d H:i:s');
            $builder->insert($berth);
        }

        echo "Erfolgreich " . count($boats) . " Boote und " . count($berths) . " Liegeplätze hinzugefügt.\n";
    }
}
