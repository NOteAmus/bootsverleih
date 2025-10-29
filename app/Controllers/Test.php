<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Test extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        
        try {
            // Verbindung testen
            $userModel->findAll();
            echo "Datenbankverbindung erfolgreich!";
        } catch (\Exception $e) {
            echo "Fehler: " . $e->getMessage();
        }
    }
}