<?php

use Screeenly\Core\Response\ApiResponse;

class ApiResponseTest extends TestCase
{
    protected function getClass()
    {
        return app()->make(ApiResponse::class);
    }

    /**
     * @test
     */
    public function it_is_instance_of_apiResponse()
    {
        $apiResponse = $this->getClass();

        $this->assertInstanceOf(ApiResponse::class, $apiResponse);
    }

    /**
     * @test
     */
    public function it_returns_headers()
    {
        $apiResponse = $this->getClass();

        $this->assertArrayHasKey('Access-Control-Allow-Origin', $apiResponse->getHeaders());

        $this->assertContains('*', $apiResponse->getHeaders());
    }

    /**
     * @test
     */
    public function it_returns_response_array()
    {
        $apiResponse = $this->getClass();

        // TODO: Implement test
    }

    /**
     * @test
     */
    public function it_sets_rate_limit_headers()
    {
        $apiResponse = $this->getClass();

        // TODO: Implement test
    }
}
