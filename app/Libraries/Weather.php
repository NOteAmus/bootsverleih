<?php
namespace App\Libraries;

use Config\Weather as WeatherConfig;

/**
 * Simple Weather service using Open-Meteo (free, no API key)
 */
class Weather
{
    protected $endpoint;
    protected $lat;
    protected $lon;
    protected $timezone;

    public function __construct()
    {
        $cfg = new WeatherConfig();
        $this->endpoint = $cfg->endpoint;
        $this->lat = $cfg->latitude;
        $this->lon = $cfg->longitude;
        $this->timezone = $cfg->timezone;
    }

    /**
     * Returns an array with normalized current weather data or null on failure.
     * Keys: temperature (°C), windspeed (km/h), description, humidity (%), uv_index, time
     */
    public function getCurrentWeather(): ?array
    {
        $params = http_build_query([
            'latitude' => $this->lat,
            'longitude' => $this->lon,
            'current_weather' => 'true',
            // request humidity, uv index, surface temperature and precipitation probability
            'hourly' => 'relativehumidity_2m,uv_index,soil_temperature_0cm,precipitation_probability',
            'timezone' => $this->timezone,
        ]);

        $url = $this->endpoint . '?' . $params;

        $context = stream_context_create([
            'http' => [
                'timeout' => 6,
                'header' => "User-Agent: bootsverleih-app/1.0\r\n",
            ],
        ]);

        $json = @file_get_contents($url, false, $context);
        if (!$json) {
            return null;
        }

        $data = json_decode($json, true);
        if (!$data || !isset($data['current_weather'])) {
            return null;
        }

        $cw = $data['current_weather'];
        $tempC = isset($cw['temperature']) ? round($cw['temperature'], 1) : null;
        $tempF = $tempC !== null ? round($tempC * 9 / 5 + 32, 1) : null;

        $result = [
            'temperature_c' => $tempC,
            'temperature_f' => $tempF,
            'windspeed' => isset($cw['windspeed']) ? round($cw['windspeed']) : null,
            'weathercode' => $cw['weathercode'] ?? null,
            'time' => $cw['time'] ?? null,
            'description' => $this->mapWeatherCode($cw['weathercode'] ?? null),
            'humidity' => null,
            'uv_index' => null,
            'water_temperature' => null,
            'precipitation_probability' => null,
        ];

        // Try to find humidity and UV index from hourly arrays for the same timestamp
        if (isset($data['hourly']['time']) && isset($result['time'])) {
            $times = $data['hourly']['time'];
            $idx = array_search($result['time'], $times);

            // If exact timestamp not found (current_weather may be on 15-min timestep),
            // pick the closest hourly timestamp instead.
            if ($idx === false) {
                $bestIdx = null;
                $bestDiff = null;
                $target = strtotime($result['time']);
                foreach ($times as $i => $t) {
                    $diff = abs(strtotime($t) - $target);
                    if ($bestDiff === null || $diff < $bestDiff) {
                        $bestDiff = $diff;
                        $bestIdx = $i;
                    }
                }
                $idx = $bestIdx;
            }

            if ($idx !== false && $idx !== null) {
                if (isset($data['hourly']['relativehumidity_2m'][$idx])) {
                    $result['humidity'] = round($data['hourly']['relativehumidity_2m'][$idx]);
                }
                if (isset($data['hourly']['uv_index'][$idx])) {
                    // uv_index can be fractional, keep one decimal
                    $result['uv_index'] = round($data['hourly']['uv_index'][$idx], 1);
                }
                if (isset($data['hourly']['soil_temperature_0cm'][$idx])) {
                    // soil_temperature_0cm represents surface temperature; for water surfaces it's the water surface temp
                    $result['water_temperature'] = round($data['hourly']['soil_temperature_0cm'][$idx], 1);
                }
                if (isset($data['hourly']['precipitation_probability'][$idx])) {
                    // precipitation probability is given as fraction 0-100
                    $result['precipitation_probability'] = round($data['hourly']['precipitation_probability'][$idx]);
                }
            }
        }

        return $result;
    }

    protected function mapWeatherCode($code): string
    {
        $map = [
            0 => 'Klarer Himmel',
            1 => 'Überwiegend klar',
            2 => 'Teilweise bewölkt',
            3 => 'Bedeckt',
            45 => 'Nebel',
            48 => 'Gefrierender Nebel',
            51 => 'Leichter Nieselregen',
            53 => 'Mäßiger Nieselregen',
            55 => 'Starker Nieselregen',
            56 => 'Leichter gefrierender Nieselregen',
            57 => 'Starker gefrierender Nieselregen',
            61 => 'Leichter Regen',
            63 => 'Mäßiger Regen',
            65 => 'Starker Regen',
            66 => 'Leichter gefrierender Regen',
            67 => 'Starker gefrierender Regen',
            71 => 'Leichter Schnee',
            73 => 'Mäßiger Schnee',
            75 => 'Starker Schnee',
            77 => 'Schneekörner',
            80 => 'Schauer (schwach)',
            81 => 'Schauer (mäßig)',
            82 => 'Schauer (stark)',
            85 => 'Schneeschauer (leicht)',
            86 => 'Schneeschauer (stark)',
            95 => 'Gewitter',
            96 => 'Gewitter mit leichtem Hagel',
            99 => 'Gewitter mit starkem Hagel',
        ];

        return isset($map[$code]) ? $map[$code] : 'Unbekannt';
    }
}
