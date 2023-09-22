<?php

if ($method == 'GET' && $uri == '/bookings') {
    try {
        $bookings = (new \Src\controllers\Booking())->getBookings();
        header('Content-Type: application/json');
        echo json_encode($bookings);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}

if ($method == 'POST' && $uri == '/booking') {
    try {
        $booking = (new \Src\controllers\Booking())->createBooking($body);
        header('Content-Type: application/json');
        echo json_encode($booking);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo $e->getMessage();
    }
    exit();
}
