<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Load current weather via Weather library (Open-Meteo)
        try {
            $weatherService = new \App\Libraries\Weather();
            $weather = $weatherService->getCurrentWeather();
        } catch (\Throwable $e) {
            // On error, fallback to null (view will show fallback values)
            $weather = null;
        }

        return view('welcome_message', ['weather' => $weather]);
    }
}
