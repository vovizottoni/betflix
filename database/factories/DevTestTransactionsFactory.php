<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DevTestTransactionsFactory extends Factory
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
            'games_id' => $this->faker->numberBetween(1, 5),
            'balance_used' => $this->faker->randomElement(['balance', 'balanceBonus', 'balanceUSD', 'balanceUSDBonus']),
            'amount' => $this->faker->numberBetween(1,500),
            'odd' => $this->faker->numberBetween(0, 9),
            'result' => $this->faker->randomElement(['pending','green','red']),
            'bet_code' => md5('dale'),
        ];
    }
}
