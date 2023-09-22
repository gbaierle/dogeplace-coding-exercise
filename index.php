<?php

require 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$body = in_array($method, ['POST', 'PUT', 'DELETE'])
    ? json_decode(file_get_contents('php://input'), true)
    : null;

include 'src/api/dog.php';
include 'src/api/client.php';
include 'src/api/booking.php';

header('HTTP/1.1 404 Not Found');
