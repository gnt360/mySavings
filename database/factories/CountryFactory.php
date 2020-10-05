<?php

namespace Database\Factories;

use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state_id' => function () {
                return State::all()->random();
            },
            'name' => $this->faker->country,
            'country_code' => $this->faker->countryCode,
        ];
    }
}