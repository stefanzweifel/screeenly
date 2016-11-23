<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\ApiKey;

class ApiV2GeneralTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_shows_error_message_if_something_goes_wrong()
    {
        $this->json('POST', '/api/v2/does-not-exist')
            ->seeJsonStructure([
                'errors'
            ]);
    }
}
