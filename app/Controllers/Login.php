<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index(): string
    {
        $data = [];
        if (session()->has('errors')) {
            $data['errors'] = session('errors');
        }

        return view('login-view', $data);
    }

    public function authenticate()
    {
        if (!$this->request->is('post')) {
            return redirect()->to(site_url('login'));
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to(site_url('login'))
                             ->with('errors', ['Ungültige E-Mail oder Passwort.'])
                             ->withInput();
        }

        if (!isset($user['passwort']) || !password_verify($password, $user['passwort'])) {
            return redirect()->to(site_url('login'))
                             ->with('errors', ['Ungültige E-Mail oder Passwort.'])
                             ->withInput();
        }

        // Erfolgreiche Anmeldung - Session setzen
        $session = session();
        $session->set('user', [
            'id' => $user['id'],
            'firstName' => $user['vorname'],
            'lastName'  => $user['nachname'],
            'email'     => $user['email']
        ]);

        return redirect()->to(site_url('/'));
    }

    public function logout()
    {
        $session = session();
        $session->remove('user');
        $session->destroy();

        return redirect()->to(site_url('/'));
    }
}
