<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['vorname', 'nachname', 'email', 'passwort', 'role'];
    
    protected $validationRules = [
        'vorname'  => 'required|min_length[2]|max_length[50]',
        'nachname' => 'required|min_length[2]|max_length[50]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'passwort' => 'required|min_length[8]'
    ];
    
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Diese E-Mail-Adresse ist bereits registriert.'
        ],
        'passwort' => [
            'min_length' => 'Das Passwort muss mindestens 8 Zeichen lang sein.'
        ]
    ];
    
    protected $beforeInsert = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['passwort'])) {
            $data['data']['passwort'] = password_hash($data['data']['passwort'], PASSWORD_DEFAULT);
        }
        
        return $data;
    }
}