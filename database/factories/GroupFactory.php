<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    protected $model = Group::class;
    /**
     * Define the model's default state.

     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_at'=> now(),
            'name' => $this->faker->name(),
            'bonus1_status' => $this->faker->randomElement(['active','inactive']),
            'bonus1_percentual_valor_integer' => $this->faker->numberBetween(0, 100),

            'bonus2_status' => $this->faker->randomElement(['active','inactive']),
            'bonus2_percentual_valor_integer' => $this->faker->numberBetween(0, 100),

            'bonus3_status' => $this->faker->randomElement(['active','inactive']),
            'bonus3_percentual_valor_integer' => $this->faker->numberBetween(0, 100),


        ];
    }
}
