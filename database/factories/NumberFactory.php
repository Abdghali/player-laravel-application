<?php

namespace Database\Factories;

use App\Models\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Number::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content'           => mt_rand(1000000000, 9999999999),
            'verification_code' => mt_rand(100000, 999999),
            'verified_at'   => null,
            'tries'     => 0,
            'last_try'  => null
        ];
    }
}
