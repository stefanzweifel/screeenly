<?php

namespace Tests\Feature\Api\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ApiV2GeneralTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_error_message_if_something_goes_wrong()
    {
        $this->postJson('/api/v2/does-not-exist')
            ->assertJsonStructure([
                'errors',
            ]);
    }
}
