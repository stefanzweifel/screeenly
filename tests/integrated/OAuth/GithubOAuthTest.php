<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GithubOAuthTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_redirects_to_github()
    {
        /*
         * How could it test this?
         */

        // $response = $this->visit("/login");
        // $this->assertRedirectedTo("http://github.com");
    }
}
