<?php

namespace Src\models;

use Src\helpers\Helpers;

class DogModel {

	private $dogData;
	private $helper;

	function __construct() {
		$this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../database/dogs.json');
		$this->dogData = json_decode($string, true);
	}

	public function getDogs() {
		return $this->dogData;
	}
}
