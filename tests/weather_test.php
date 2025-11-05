<?php
require __DIR__ . '/../vendor/autoload.php';
$w = new \App\Libraries\Weather();
$data = $w->getCurrentWeather();
print_r($data);

echo "\nDone.\n";
