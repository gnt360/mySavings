<?php

namespace Database\Factories;

use App\Models\SubscriberCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriberCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscriber_id' => Str::uuid(),
            'name' => $this->faker->name,
            'reg_amount' => $this->faker->numberBetween(100,1000),
            'promo_amount'=> $this->faker->numberBetween(100,500),
        ];
    }
}
