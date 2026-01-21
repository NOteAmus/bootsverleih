<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        // users muss existieren, sonst bricht addColumn() ab
        if (! $this->db->tableExists('users')) {
            return; // alternativ: throw new \RuntimeException('users table missing');
        }

        // wenn role schon da ist, nichts tun
        if ($this->db->fieldExists('role', 'users')) {
            return;
        }

        $this->forge->addColumn('users', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'admin', 'worker'],
                'default'    => 'user',
                'null'       => false,
                // Achtung: "passwort" existiert sehr wahrscheinlich nicht. Nutze "password" oder entferne after komplett.
                'after'      => 'password',
            ],
        ]);
    }

    public function down()
    {
        if ($this->db->tableExists('users') && $this->db->fieldExists('role', 'users')) {
            $this->forge->dropColumn('users', 'role');
        }
    }
}
