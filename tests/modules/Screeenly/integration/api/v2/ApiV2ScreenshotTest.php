<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Models\ApiKey;
use Screeenly\Services\InMemoryBrowser;

class ApiV2ScreenshotTest extends BrowserKitTestCase
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
        $apiKey = ApiKey::factory()->create();

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
        $apiKey = ApiKey::factory()->create();

        $this->json('POST', '/api/v2/screenshot', [
            'key' => $apiKey->key,
            'url' => 'Foo',
        ])
            ->seeJson([
                'url' => ['The url format is invalid.', 'The url is not a valid URL.'],
            ]);
    }

    /** @test */
    public function it_returns_base64_representation_of_screenshot()
    {
        Storage::fake(config('screeenly.filesystem_disk'));

        Storage::disk(config('screeenly.filesystem_disk'))
            ->put(
                'test-screenshot.jpg',
                file_get_contents(storage_path('testing/test-screenshot.jpg'))
            );

        $apiKey = ApiKey::factory()->create();

        $this->app->bind(CanCaptureScreenshot::class, function ($app) {
            return new InMemoryBrowser('http://foo.bar', '/path/to/storage');
        });

        $this->json('POST', '/api/v2/screenshot', [
            'key' => $apiKey->key,
            'url' => 'http://google.com',
        ])
        ->seeJsonStructure([
            'data' => [
                'path', 'base64',
            ],
        ]);
    }
}
