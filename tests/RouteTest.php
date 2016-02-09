<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testTryPage()
    {
        $crawler = $this->call('GET', '/try');
        $this->assertResponseOk();
    }

    public function testTryWithWrongProof()
    {
        $response = $this->call('POST', '/try', [
                'url'   => 'http://google.com',
                'key'   => 'something',
                'proof' => 'something',
        ]);

        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('home.landingpage');
    }

    public function testTryWithCorrectProof()
    {
        $token = csrf_token();

        $response = $this->call('POST', '/try', [
                'url'   => 'http://google.com',
                'key'   => 'something',
                'proof' => 'laravel',
        ]);

        $this->assertResponseStatus(302);
        // $this->assertRedirectedTo('try');
        $this->assertRedirectedToRoute('try');
        $this->assertSessionHas('asset');
    }
}
