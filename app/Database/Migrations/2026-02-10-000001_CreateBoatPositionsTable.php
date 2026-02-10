<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBoatPositionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ship_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'ID des Schiffs (kann auf items.id referenzieren oder standalone sein)',
            ],
            'ship_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => 'Name des Schiffs',
            ],
            'slot_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'Slot-Nummer z.B. A2, B3',
            ],
            'grid_x' => [
                'type' => 'INT',
                'constraint' => 11,
                'comment' => 'X-Position im Grid',
            ],
            'grid_y' => [
                'type' => 'INT',
                'constraint' => 11,
                'comment' => 'Y-Position im Grid',
            ],
            'grid_width' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 2,
                'comment' => 'Breite im Grid',
            ],
            'grid_height' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 2,
                'comment' => 'Höhe im Grid',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('ship_id');
        $this->forge->addKey('slot_number');
        $this->forge->createTable('boat_positions');
    }

    public function down()
    {
        $this->forge->dropTable('boat_positions');
    }
}
