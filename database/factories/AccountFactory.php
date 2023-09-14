<?php

namespace Database\Factories;

use App\Models\Bet;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bet>
 */
class AccountFactory extends Factory
{
    protected $model = Bet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo' => "assets/images/avatars/avatar-1.jpeg",
            'odd' => $this->faker->randomDigit(),
            'result' => $this->faker->name,
            'balance' => 0,
            'balanceBonus' => 0,
            'balanceUSD' => 0,
            'balanceUSDBonus' => 0
        ];
    }

    public function whithUser($userId)
    {
        $user = User::findOrFail($userId);
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
                'name' => $user->name,

            ];
        });
    }
}
