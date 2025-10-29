<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Registration extends Controller
{
    public function index(): string
    {
        // Fehlermeldungen an View übergeben
        $data = [];
        if (session()->has('errors')) {
            $data['errors'] = session('errors');
        }
        
        return view('register-view', $data);
    }

    public function register()
    {
        if (!$this->request->is('post')) {
            return redirect()->to(site_url('register'));
        }

        $userModel = new UserModel();

        $data = [
            'vorname'  => $this->request->getPost('firstName'),
            'nachname' => $this->request->getPost('lastName'),
            'email'    => $this->request->getPost('email'),
            'passwort' => $this->request->getPost('password')
        ];

        if ($userModel->save($data)) {
            return view('register_success', [
                'firstName' => $data['vorname'],
                'lastName'  => $data['nachname'],
                'email'     => $data['email']
            ]);
        } else {
            return redirect()->to(site_url('register'))
                            ->withInput()
                            ->with('errors', $userModel->errors());
        }
    }
}