<?php

namespace Src\models;

use DateTime;
use Src\helpers\Helpers;

class ClientModel {

	private $clientData;
	private $helper;

	function __construct() {
		$this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../database/clients.json');
		$this->clientData = json_decode($string, true);
	}

	public function getClients() {
		return $this->clientData;
	}

	public function createClient($data) {
		$clients = $this->getClients();

		$data['id'] = end($clients)['id'] + 1;
		$clients[] = $data;

		$this->helper->putJson($clients, 'clients');

		return $data;
	}

	public function updateClient($data) {
		$updateClient = [];
		$clients = $this->getClients();
		foreach ($clients as $key => $client) {
			if ($client['id'] == $data['id']) {
				$clients[$key] = $updateClient = array_merge($client, $data);
			}
		}

		$this->helper->putJson($clients, 'clients');

		return $updateClient;
	}

	public function deleteClient($id) {
		$clients = $this->getClients();
		foreach ($clients as $key => $client) {
			if ($client['id'] == $id) {
				$client['deletedat'] = (new DateTime())->format('Y-m-d H:i:s');
				$clients[$key] = $client;
			}
		}

		$this->helper->putJson($clients, 'clients');
	}

	public function getClientById($id) {
		$clients = $this->getClients();
		foreach ($clients as $client) {
			if ($client['id'] == $id) {
				return $client;
			}
		}
		return null;
	}
}
