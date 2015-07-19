<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
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

        $this->setupDatabase();

        return $app;
    }

    /**
     * Create SQLite Database and Migrate everything
     * @return void
     */
    public function setupDatabase()
    {
        if (!File::exists( storage_path('database.sqlite') )) {

            File::put( storage_path('database.sqlite'), '');

        }

        Artisan::call('migrate:refresh');
    }
}
