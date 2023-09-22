<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\controllers\Client;

class ClientTest extends TestCase {

	private $client;

	/**
	 * Setting default data
	 * @throws \Exception
	 */
	public function setUp(): void {
		parent::setUp();
		$this->client = new Client();
	}

	/** @test */
	public function getClients() {
		$results = $this->client->getClients();

		$this->assertIsArray($results);
		$this->assertIsNotObject($results);

		$this->assertEquals($results[0]['id'], 1);
		$this->assertEquals($results[0]['username'], 'arojas');
		$this->assertEquals($results[0]['name'], 'Antonio Rojas');
		$this->assertEquals($results[0]['email'], 'arojas@dogeplace.com');
		$this->assertEquals($results[0]['phone'], '1234567');
	}

	public function createClient() {
		$client = [
			'username' => 'newuser',
			'name' => 'New User',
			'email' => 'newuser@dogeplace.com',
			'phone' => '5555555'
		];

		$this->client->createClient($client);
		$results = $this->client->getClients();

		$this->assertIsArray($results);
		$this->assertIsNotObject($results);
	}

	public function updateClient() {
		$client = [
			'id' => 3,
			'username' => 'cperez',
			'name' => 'Carlos Perez',
			'email' => 'cperez@dogeplace.com',
			'phone' => '2222222'
		];

		$this->client->updateClient($client);
		$results = $this->client->getClients();

		$this->assertIsArray($results);
		$this->assertIsNotObject($results);
	}

	public function testClientSoftDelete() {
		$client = [
			'username' => 'newuser',
			'name' => 'New User',
			'email' => 'newuser@dogeplace.com',
			'phone' => '5555555'
		];

		$newClient = $this->client->createClient($client);
		$this->client->deleteClient($newClient['id']);

		$client = $this->client->getClientById($newClient['id']);
		$this->assertNotNull($client);
		$this->assertArrayHasKey('deletedat', $client);
	}

	public function testCreateWithInvalidEmailShouldReturnException() {
		$client = [
			'username' => 'newuser',
			'name' => 'New User',
			'email' => 'newuser@invalid',
			'phone' => '5555555'
		];

		$this->expectException(\Exception::class);
		$this->client->createClient($client);
	}

	public function testEmailShouldBeUnique() {
		$client = [
			'username' => 'newuser',
			'name' => 'New User',
			'email' => 'arojas@dogeplace.com',
			'phone' => '5555555'
		];

		$this->expectException(\Exception::class);
		$this->client->createClient($client);
	}
}
