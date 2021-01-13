<?php



namespace Database\Factories\Screeenly\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

class ApiKeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiKey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'key' => Str::random(10),
            'user_id' => User::factory(),
        ];
    }
}
