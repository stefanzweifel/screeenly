<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\ApiKey;

class ApiV2ScreenshotTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithBrowser;

    /** @test */
    public function it_shows_error_message_if_no_api_key_is_provided()
    {
        $this->json('POST', '/api/v2/screenshot', [])
            ->seeJson([
                'error' => 'Unauthenticated.',
            ]);
    }

    /** @test */
    public function it_shows_error_if_no_url_is_provied()
    {
        $apiKey = factory(ApiKey::class)->create();

        $this->json('POST', '/api/v2/screenshot', [
                'key' => $apiKey->key,
            ])
            ->seeJson([
                'url' => ['The url field is required.'],
            ]);
    }

    /** @test */
    public function it_shows_error_if_not_a_url_is_passed()
    {
        $apiKey = factory(ApiKey::class)->create();

        $this->json('POST', '/api/v2/screenshot', [
                'key' => $apiKey->key,
                'url' => 'Foo',
            ])
            ->seeJson([
                'url' => ['The url format is invalid.'],
            ]);
    }

    /** @test */
    public function it_returns_base64_representation_of_screenshot()
    {
        $apiKey = factory(ApiKey::class)->create();

        $this->json('POST', '/api/v2/screenshot', [
                'key' => $apiKey->key,
                'url' => 'http://google.com',
            ]);
    }
}
