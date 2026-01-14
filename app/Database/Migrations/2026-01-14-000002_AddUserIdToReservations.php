<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToReservations extends Migration
{
    public function up()
    {
        $this->forge->addColumn('reservations', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id'
            ]
        ]);

        // Foreign Key Constraint hinzufügen
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_reservations_user_id');
    }

    public function down()
    {
        // Foreign Key entfernen
        $this->forge->dropForeignKey('reservations', 'fk_reservations_user_id');
        
        // Spalte entfernen
        $this->forge->dropColumn('reservations', 'user_id');
    }
}
