<?php

// Get visitor name from query parameter
$visitor_name = isset($_GET['visitor_name']) ? $_GET['visitor_name'] : 'Guest';

// Get client IP address
$client_ip = $_SERVER['REMOTE_ADDR'];

// Use a third-party API to get location data based on IP
$location_data = json_decode(file_get_contents("http://ip-api.com/json/{$client_ip}"));
$city = $location_data->city;

// Use a weather API to get real-time temperature (example using OpenWeatherMap API)
// You need to sign up for an API key at https://openweathermap.org/api
$api_key = 'your_openweathermap_api_key';
$weather_data = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$api_key}"));
$temperature = $weather_data->main->temp;

// Create response array
$response = [
    "client_ip" => $client_ip,
    "location" => $city,
    "greeting" => "Hello, $visitor_name! The temperature is $temperature degrees Celsius in $city"
];

// Set header to JSON
header('Content-Type: application/json');

// Output response in JSON format
echo json_encode($response);

?>
