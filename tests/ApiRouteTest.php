<?php

class ApiRouteTest extends TestCase {

	public function testRouteOnlyByPost()
	{
		$this->call('GET', '/api/v1/fullsize');

        $this->assertResponseStatus(405);
	}

	public function testRouteAuthentication()
	{
		$response = $this->call(
			'POST',
			'/api/v1/fullsize'
		);

		$this->assertResponseStatus(401);
	}

	public function testRouteNeedsValidKey()
	{
		$response = $this->call(
			'POST',
			'/api/v1/fullsize',
			['key' => 'something']
		);

		$this->assertResponseStatus(403);
	}

}
