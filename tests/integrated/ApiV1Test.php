<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiV1Test extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_a_screenshot()
    {
        $users = factory(Screeenly\User::class, 10)
            ->create()
            ->each(function ($u) {
                $u->apikeys()->save(factory(Screeenly\ApiKey::class)->make());
            });

        $key = Screeenly\ApiKey::first();

        $arguments = [
            'key' => $key->key,
            'url' => 'http://google.com'
        ];

        $this->post('/api/v1/fullsize', $arguments)
             ->seeJson([
                 'base64_raw' => null,
             ]);
    }

    /**
     * @test
     */
    public function it_does_need_an_url()
    {
        $users = factory(Screeenly\User::class, 10)
            ->create()
            ->each(function ($u) {
                $u->apikeys()->save(factory(Screeenly\ApiKey::class)->make());
            });

        $key = Screeenly\ApiKey::first();

        $arguments = [
            'key' => $key->key,
        ];

        $this->post('/api/v1/fullsize', $arguments)
             ->seeJson([
                 "message" => "Validation Error: The url field is required."
             ]);
    }

    /**
     * @test
     */
    public function it_does_not_allow_get_request()
    {
        $this->call('GET', '/api/v1/fullsize');

        $this->assertResponseStatus(405);
    }

    /**
     * @test
     */
    public function it_does_need_an_api_key()
    {
        $arguments = [
            'url' => 'http://google.com'
        ];

        $this->post('/api/v1/fullsize', $arguments)
             ->seeJson([
                'title' => 'An error accoured',
                'message' => 'No API Key specified.',
             ]);

        $this->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function it_does_nedd_a_valid_api_key()
    {
        $arguments = [
            'key' => 'nope',
            'url' => 'http://google.com'
        ];

        $this->post('/api/v1/fullsize', $arguments)
             ->seeJson([
                'title' => 'An error accoured',
                'message' => 'Access denied.',
             ]);

        $this->assertResponseStatus(403);
    }
}
