<?php

use Screeenly\Screenshot\ScreenshotValidator;

class ScreenshotValidatorTest extends TestCase {

	public function testTrueParameters()
	{
		$data = [
			'key'    => 'some-api-key',
			'url'    => 'http://google.com',
			'height' => 500,
			'width'  => 500
		];

		$validator = new ScreenshotValidator();
		$response = $validator->validate($data);
		$this->assertEquals(null, $response);

	}

	/**
     * @expectedException Exception
     */
	public function testNoKey()
	{
		$data = [
			'url'    => 'http://google.com',
			'height' => 500,
			'width'  => 500
		];

		$validator = new ScreenshotValidator();
		$validator->validate($data);
		$this->assertResponseStatus(400);
	}

	/**
     * @expectedException Exception
     */
	public function testNoUrl()
	{
		$data = [
			'key'    => 'some-key',
			'height' => 500,
			'width'  => 500
		];

		$validator = new ScreenshotValidator();
		$validator->validate($data);
		$this->assertResponseStatus(400);
	}

	/**
     * @expectedException Exception
     */
	public function testNotAnUrl()
	{
		$data = [
			'key' => 'some-key',
			'url' => 'this-is-not-an-url',
		];

		$validator = new ScreenshotValidator();
		$validator->validate($data);
		$this->assertResponseStatus(400);
	}

	/**
     * @expectedException Exception
     */
	public function testHeightIsNotInteger()
	{
		$data = [
			'key'    => 'some-key',
			'url'    => 'http://google.com',
			'height' => 'string'
		];

		$validator = new ScreenshotValidator();
		$validator->validate($data);
		$this->assertResponseStatus(400);
	}

	/**
     * @expectedException Exception
     */
	public function testWidthIsNotInteger()
	{
		$data = [
			'key'   => 'some-key',
			'url'   => 'http://google.com',
			'width' => 'string'
		];

		$validator = new ScreenshotValidator();
		$validator->validate($data);
		$this->assertResponseStatus(400);
	}

}
