<?php



namespace Database\Factories\Screeenly\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Screeenly\Models\ApiKey;
use Screeenly\Models\ApiLog;
use Screeenly\Models\User;

class ApiLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        $imagePath = storage_path('app/public');

        return [
            'user_id' => $user,
            'api_key_id' => ApiKey::factory()->create(['user_id' => $user->id])->id,
            'images' => $this->faker->image($imagePath, $width = 640, $height = 480),
        ];
    }
}
