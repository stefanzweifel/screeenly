<?php

class RouteTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testHomepage()
	{
		$crawler = $this->call('GET', '/');
		$this->assertResponseOk();
	}

	public function testTryPage()
	{
		$crawler = $this->call('GET', '/try');
		$this->assertResponseOk();
	}

	public function testTryWithWrongProof()
	{
		$response = $this->action(
			'POST',
			'PagesController@createTestScreenshot',
			['url' => 'http://google.com', 'key' => 'something', 'proof' => 'something']
		);

		$this->assertRedirectedToRoute('home.landingpage');

	}

	public function testTryWithCorrectProof()
	{
		$response = $this->action(
			'POST',
			'PagesController@createTestScreenshot',
			['url' => 'http://google.com', 'key' => 'something', 'proof' => 'laravel']
		);

		$this->assertRedirectedToRoute('try');
		$this->assertSessionHas('asset');

	}

}
