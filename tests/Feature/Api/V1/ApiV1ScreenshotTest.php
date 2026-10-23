<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\ApiKey;
use Screeenly\Models\ApiLog;
use Tests\Concerns\InteractsWithBrowser;
use Tests\TestCase;

class ApiV1ScreenshotTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithBrowser;

    #[Test]
    public function it_return_an_error_if_no_api_key_was_passed_to_the_api()
    {
        $this->postJson('/api/v1/fullsize', [])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'No API Key specified.',
            ]);
    }

    #[Test]
    public function it_returns_an_error_if_no_url_was_passed_to_the_api()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The url field is required.',
            ]);
    }

    #[Test]
    public function it_returns_an_error_if_width_is_to_big()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'https://google.com',
            'width' => '5000',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The width may not be greater than 2000.',
            ]);
    }

    #[Test]
    public function it_returns_an_errof_if_width_is_lower_than_minimum()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'https://google.com',
            'width' => '5',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The width must be at least 10.',
            ]);
    }

    #[Test]
    public function it_returns_an_errof_if_height_is_lower_than_minimum()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'https://google.com',
            'height' => '5',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The height must be at least 10.',
            ]);
    }

    #[Test]
    public function it_returns_an_error_if_delay_is_over_15_seconds()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'https://google.com',
            'delay' => '18',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The delay may not be greater than 15.',
            ]);
    }

    #[Test]
    public function it_returns_an_error_if_delay_key_is_in_request_but_no_value()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'https://google.com',
            'delay' => '',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The delay field is required.',
            ]);
    }

    #[Test]
    public function it_returns_an_errof_if_url_has_no_protocol_prefix()
    {
        $apiKey = ApiKey::factory()->create();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'foo.com',
        ])
            ->assertExactJson([
                'title' => 'An error accoured',
                'message' => 'Validation Error: The url format is invalid.',
            ]);
    }

    #[Test]
    public function it_returns_path_and_base64_representation_of_to_image_on_successful_request()
    {
        Storage::fake(config('screeenly.filesystem_disk'));

        Storage::disk(config('screeenly.filesystem_disk'))
            ->put(
                'test-screenshot.jpg',
                file_get_contents(storage_path('testing/test-screenshot.jpg'))
            );

        $apiKey = ApiKey::factory()->create();
        $this->replaceBinding();

        $this->postJson('/api/v1/fullsize', [
            'key' => $apiKey->key,
            'url' => 'http://foo.com',
        ])->assertJsonStructure([
            'path',
            'base64',
            'base64_raw',
        ]);

        $log = ApiLog::where('user_id', $apiKey->user_id)->first();

        $this->assertEquals('127.0.0.1', $log->ip_address);
        $this->assertNotNull($log->images);
    }

    #[Test]
    public function it_returns_generic_error_if_something_goes_wrong()
    {
        $this->postJson('/api/v1/does-not-exist', [])
            ->assertJson([
                'title' => 'An error accoured',
                'message' => 'An internal error accoured.',
            ]);
    }
}
