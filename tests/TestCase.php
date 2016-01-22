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
        if (File::exists(database_path('database.sqlite'))) {
            File::delete(database_path('database.sqlite'));
        }

        File::put(database_path('database.sqlite'), '');

        // `migrate:refresh` is not usable, because it messed up with the
        // migration setup. Before we start testing, we just delete an
        // available sqlite-database and create a new one.

        Artisan::call('migrate:install');
        // Artisan::call('migrate');
    }
}
