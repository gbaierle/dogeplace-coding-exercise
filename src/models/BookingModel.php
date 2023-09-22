<?php

namespace Src\models;

use Src\helpers\Helpers;

class BookingModel {

	private $bookingData;
	private $helper;

	function __construct() {
		$this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../database/bookings.json');
		$this->bookingData = json_decode($string, true);
	}

	public function getBookings() {
		return $this->bookingData;
	}

	public function createBooking(array $data): array {
		$bookings = $this->bookingData;

		$dogsAverageAge = $this->getDogsAverageAge($data['clientid']);
		$data['id'] = end($bookings)['id'] + 1;
		$data['price'] = $this->canHaveDiscount($data['clientid']) ? $data['price'] * 0.9 : $data['price'];

		$bookings[] = $data;

		$this->helper->putJson($bookings, 'bookings');

		return $data;
	}

	private function canHaveDiscount(int $clientid): bool {
		$dogsAverageAge = $this->getDogsAverageAge($clientid);
		return $dogsAverageAge < 10;
	}

	private function getDogsAverageAge(int $clientid): int {
		$dogs = (new DogModel())->getDogs();
		$averageAge = 0;
		$count = 0;
		foreach ($dogs as $dog) {
			if ($dog['clientid'] === $clientid) {
				$averageAge += $dog['age'];
				$count++;
			}
		}

		if ($count === 0) {
			return 0;
		}

		return $averageAge / $count;
	}
}
