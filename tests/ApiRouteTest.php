<?php

class ApiRouteTest extends TestCase {

	public function testRouteOnlyByPost()
	{
		$this->call('GET', '/api/v1/fullsize');

        $this->assertResponseStatus(405);
	}

	/**
     * @expectedException Exception
     */
	public function testRouteAuthentication()
	{
		$this->call(
			'POST',
			'/api/v1/fullsize'
		);
	}

	/**
     * @expectedException Exception
     */
	public function testRouteNeedsValidKey()
	{
		$this->call(
			'POST',
			'/api/v1/fullsize',
			['key' => 'something']
		);
	}

}
