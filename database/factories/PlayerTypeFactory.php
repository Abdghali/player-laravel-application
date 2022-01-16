<?php

namespace Database\Factories;

use App\Models\PlayerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayerType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'   => $this->faker->name
        ];
    }
}
