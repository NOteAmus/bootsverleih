<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Registration extends Controller
{
    public function index(): string
    {
        return view('register-view');
    }

    public function register()
    {
        $firstName = $this->request->getPost('firstName');
        $lastName  = $this->request->getPost('lastName');
        $email     = $this->request->getPost('email');
        $password  = $this->request->getPost('password');

        return view('register_success', [
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'email'     => $email
        ]);
    }
}
