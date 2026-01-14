<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
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
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['boot', 'liegeplatz'],
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'e.g. premium, comfort, standard, economy',
            ],
            // Boot-spezifische Felder
            'boat_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'e.g. Segelyacht, Motorboot, Schlauchboot',
            ],
            'length' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'comment' => 'Length in meters',
            ],
            'year' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true,
            ],
            'capacity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'comment' => 'Max persons',
            ],
            // Liegeplatz-spezifische Felder
            'slot_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'e.g. A1, B2, C3',
            ],
            'row' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'position' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'max_boat_length' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'comment' => 'Maximum boat length for berth',
            ],
            // Gemeinsame Felder
            'price_per_day' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'features' => [
                'type' => 'JSON',
                'null' => true,
                'comment' => 'JSON array of features',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('type');
        $this->forge->addKey('is_active');
        $this->forge->addKey(['type', 'is_active']);

        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}
