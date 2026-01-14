<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReservationTypeToReservations extends Migration
{
    public function up()
    {
        $fields = [
            'reservation_type' => [
                'type' => 'ENUM',
                'constraint' => ['boot', 'liegeplatz'],
                'default' => 'boot',
                'after' => 'reservation_number',
            ],
            'item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'reservation_type',
                'comment' => 'Reference to items table (boot or liegeplatz)',
            ],
        ];

        $this->forge->addColumn('reservations', $fields);

        // Add index for better query performance
        $this->forge->addKey(['reservation_type', 'item_id']);
    }

    public function down()
    {
        $this->forge->dropColumn('reservations', ['reservation_type', 'item_id']);
    }
}
