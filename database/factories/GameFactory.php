<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fees'           => rand(20, 50),
            'start'          => now()->addDays(random_int(5,10)),
            'max_players'    => rand(11, 16),
            'admin_id'       => $this->faker->randomElement(Admin::all())->id,
            'playground_id'  => rand(1, 30),
            'description'    => $this->faker->sentence(4),
            'type'           => Game::RUNNNIG,
        ];
    }


    public function waiting()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Game::WAITNIG,
            ];
        });
    }
}
