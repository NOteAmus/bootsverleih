<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationTable extends Migration
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
            'reservation_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'boat_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'boat_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
            ],
            'days' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'price_per_day' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'boat_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'service_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 25.00,
            ],
            'insurance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 35.00,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'paypal',
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'paid', 'cancelled'],
                'default' => 'paid',
            ],
            'additional_equipment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'experience_level' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
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
        $this->forge->addUniqueKey('reservation_number');
        $this->forge->addKey('customer_email');
        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
