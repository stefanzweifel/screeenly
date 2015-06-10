<?php

class ApiRouteTest extends TestCase
{
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

        $errorMessage = [
            'title' => 'An error accoured',
            'message' => 'No API Key specified.',
        ];

        $this->assertEquals(json_encode($errorMessage), $response->getContent());

        $this->assertResponseStatus(401);
    }

    public function testRouteNeedsValidKey()
    {
        $response = $this->call(
            'POST',
            '/api/v1/fullsize',
            ['key' => 'something']
        );

        $errorMessage = [
            'title' => 'An error accoured',
            'message' => 'Access denied.',
        ];

        $this->assertEquals(json_encode($errorMessage), $response->getContent());

        $this->assertResponseStatus(403);
    }
}
