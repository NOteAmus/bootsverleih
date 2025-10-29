<?php

namespace App\Controllers;

class Registration extends BaseController
{
    public function index(): string
    {
        return view('register-view');
    }
}
