<?php

use Screeenly\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * @var Screeenly\User
     */
    protected $user;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        \Artisan::call('migrate');

        return $app;
    }

    /**
     * Act as a User.
     *
     * @return void
     */
    protected function beUser()
    {
        $this->user = factory(User::class)->create();

        $this->actingAs($this->user);
    }
}
