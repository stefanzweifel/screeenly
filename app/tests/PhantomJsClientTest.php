<?php

use Screeenly\Screenshot\PhantomJsClient;

class PhantomJsClientTest extends TestCase {

	public function testIsInstanceOf()
	{
		$client = new PhantomJsClient();
		$this->assertInstanceOf('Screeenly\Screenshot\ClientInterface', $client, "Client doesn't include ClientInterface!");
	}

	public function testHasBuildMethod()
	{
		$client = new PhantomJsClient();

		$this->assertTrue(
			method_exists($client, 'build'),
		  	'Class does not have method build'
		);

	}

	public function testHasCaptureMethod()
	{
		$client = new PhantomJsClient();

		$this->assertTrue(
			method_exists($client, 'capture'),
		  	'Class does not have method capture'
		);

	}

}
