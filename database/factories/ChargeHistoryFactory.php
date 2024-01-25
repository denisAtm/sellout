<?php

namespace Database\Factories;

use App\Models\ChargeHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChargeHistory>
 */
class ChargeHistoryFactory extends Factory
{
    protected $model = ChargeHistory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'points' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'comment' => $this->faker->sentence(),
        ];
    }
}
