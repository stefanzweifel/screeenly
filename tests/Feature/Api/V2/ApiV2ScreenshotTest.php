<?php

namespace Tests\Feature\Api\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Models\ApiKey;
use Screeenly\Services\InMemoryBrowser;
use Tests\Concerns\InteractsWithBrowser;
use Tests\TestCase;

class ApiV2ScreenshotTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithBrowser;

    #[Test]
    public function it_shows_error_message_if_no_api_key_is_provided()
    {
        $this->postJson('/api/v2/screenshot', [])
            ->assertJson([
                'error' => 'Unauthenticated.',
            ]);
    }

    #[Test]
    public function it_shows_error_if_no_url_is_provied()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v2/screenshot', [
            'key' => $apiKey->key,
        ])
            ->assertJson([
                'url' => ['The url field is required.'],
            ]);
    }

    #[Test]
    public function it_shows_error_if_not_a_url_is_passed()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v2/screenshot', [
            'key' => $apiKey->key,
            'url' => 'Foo',
        ])
            ->assertJson([
                'url' => ['The url format is invalid.', 'The url is not a valid URL.'],
            ]);
    }

    #[Test]
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

        $this->postJson('/api/v2/screenshot', [
            'key' => $apiKey->key,
            'url' => 'http://google.com',
        ])
        ->assertJsonStructure([
            'data' => [
                'path', 'base64',
            ],
        ]);
    }
}
