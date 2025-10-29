<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserSession extends Controller
{
    public function getCurrentUser()
    {
        // In einer echten Anwendung würden Sie hier die Session prüfen
        // Für dieses Beispiel nehmen wir an, der eingeloggte User hat ID 1
        
        $userModel = new UserModel();
        $user = $userModel->find(1); // Ersten Benutzer laden
        
        if ($user) {
            return $this->response->setJSON([
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'firstName' => $user['vorname'],
                    'lastName' => $user['nachname'],
                    'email' => $user['email'],
                    'initials' => strtoupper(substr($user['vorname'], 0, 1) . substr($user['nachname'], 0, 1))
                ]
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Benutzer nicht gefunden'
        ]);
    }
}