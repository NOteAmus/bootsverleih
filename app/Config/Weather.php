<?php
namespace Config;

/**
 * Weather configuration
 */
class Weather
{
    // Open-Meteo endpoint (kostenlos, kein API-Key nötig)
    public $endpoint = 'https://api.open-meteo.com/v1/forecast';

    // Default coordinates for Plau am See (can be overridden)
    public $latitude = 53.429; // approx Plau am See
    public $longitude = 12.151;

    // Timezone for API responses
    public $timezone = 'Europe/Berlin';
}
