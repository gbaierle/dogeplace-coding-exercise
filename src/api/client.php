<?php

if ($method == 'GET' && $uri == '/clients') {
    try {
        $clients = (new \Src\controllers\Client())->getClients();
        header('Content-Type: application/json');
        echo json_encode($clients);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}

if ($method == 'POST' && $uri == '/client') {
    try {
        $newClient = (new \Src\controllers\Client())->createClient($body);
        header('Content-Type: application/json');
        echo json_encode($newClient);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}

if ($method == 'PUT' && $uri == '/client') {
    try {
        $client = (new \Src\controllers\Client())->updateClient($body);
        header('Content-Type: application/json');
        echo json_encode($client);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}

if ($method == 'DELETE' && strpos($uri, 'client')) {
    $urlParts = explode('/', $uri);
    if (!isset($urlParts[2])) {
        header('HTTP/1.1 404 Not Found');
        exit();
    }

    $clientId = $urlParts[2];
    try {
        (new \Src\controllers\Client())->deleteClient($clientId);
        header('HTTP/1.1 204 No Content');
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}
