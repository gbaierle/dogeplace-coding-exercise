<?php

if ($method == 'GET' && $uri == '/dogs') {
    try {
        $dogs = (new \Src\controllers\Dog())->getDogs();
        header('Content-Type: application/json');
        echo json_encode($dogs);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}
