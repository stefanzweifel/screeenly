<?php

namespace Screeenly\Console\Commands;

use Illuminate\Console\Command;
use Screeenly\User;
use Screeenly\ApiKey;

class MigrateApiKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screeenly:migrateApiKeys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate V1 API keys to V2.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Begin API Key Migration');

        $users = User::all();

        foreach ($users as $key => $user) {

            $this->migrateUser($user);

        }


        $this->info("Migration completed");
    }

    /**
     * Migrate Users API Key to it's own model
     *
     * - Create new Model
     * - Delete old value
     *
     * @param  User   $user
     * @return void
     */
    protected function migrateUser(User $user)
    {
        $apiKey = $user->api_key;

        $newKey = new ApiKey();

        $newKey->key = $apiKey;
        $newKey->name = 'Default key';
        $newKey->user_id = $user->id;
        $newKey->save();

        $newKey->user()->associate($user);
        $newKey->save();


        // $newKey = ApiKey::create([
        //     'key'     => $apiKey,
        //     'user_id' => $user->id,
        //     'name'    => 'Default key'
        // ]);

        $user->api_key = "key-deleted-" . str_random(10);
        $user->save();

    }
}
