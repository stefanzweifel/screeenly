<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiV2Test extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

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

        $this->post('/api/v2/fullsize', $arguments)
             ->seeJson([
                "meta" => [
                    'http_status' => 201
                ]
             ]);

        $this->clearScreenshotFolder();
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

        $this->post('/api/v2/fullsize', $arguments)
             ->seeJson([
                 "detail" => "The url field is required."
             ]);

        $this->assertResponseStatus(422);
    }

    /**
     * @test
     */
    public function it_does_not_allow_get_request()
    {
        $this->call('GET', '/api/v2/fullsize');

        $this->assertResponseStatus(500);
    }

    /**
     * @test
     */
    public function it_does_need_an_api_key()
    {
        $arguments = [
            'url' => 'http://google.com'
        ];

        $this->post('/api/v2/fullsize', $arguments)
            ->seeStatusCode(401)
             ->seeJson([
                'detail' => 'No API Key specified.',
             ]);
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

        $this->post('/api/v2/fullsize', $arguments)
            ->seeStatusCode(403)
            ->seeJson(["detail" => "Access denied."]);
    }






    /**
     * Clear out all screenshots from the screenshot directory
     * TODO: Should be removed, as soon as the virtual-filesystem is integrated
     */
    protected function clearScreenshotFolder()
    {
        $screenshot = app()->make(Screeenly\Core\Screeenshot\Screenshot::class);
        $path = $screenshot->setStoragePath();
        $files = \Storage::files($path);

        array_filter($files, function ($file) {
            \Storage::delete($file);
        });
    }
}
