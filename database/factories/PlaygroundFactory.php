<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Playground;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaygroundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Playground::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->name,
            'city_id'  => $this->faker->randomElement(City::cursor())->id,
            'lng'   => $this->faker->longitude,
            'lat'   => $this->faker->latitude,
        ];
    }
}
