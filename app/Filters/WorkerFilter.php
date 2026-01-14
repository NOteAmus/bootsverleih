<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class WorkerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->has('user')) {
            return redirect()->to('/login')->with('error', 'Bitte loggen Sie sich ein.');
        }

        $user = $session->get('user');
        
        // Check if user has admin or worker role
        if (!in_array($user['role'], ['admin', 'worker'])) {
            return redirect()->to('/')->with('error', 'Sie haben keine Berechtigung für diesen Bereich.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
