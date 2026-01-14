<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ApiCurrentUser extends Controller
{
    public function getCurrentUser()
    {
        $session = session();

        if (!$session->has('user')) {
            return $this->response->setJSON([
                'success' => false,
                'user'    => null
            ]);
        }

        $u = $session->get('user');

        $first = isset($u['firstName']) && $u['firstName'] !== '' ? mb_substr($u['firstName'], 0, 1) : '';
        $last  = isset($u['lastName']) && $u['lastName'] !== '' ? mb_substr($u['lastName'], 0, 1) : '';
        $initials = mb_strtoupper($first . $last);

        $user = [
            'id' => $u['id'] ?? null,
            'firstName' => $u['firstName'] ?? '',
            'lastName'  => $u['lastName'] ?? '',
            'email'     => $u['email'] ?? '',
            'role'      => $u['role'] ?? 'user',
            'initials'  => $initials
        ];

        return $this->response->setJSON([
            'success' => true,
            'user'    => $user
        ]);
    }
}
