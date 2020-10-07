<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\User;
use App\Models\SubscriberCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscriber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => function () {
                return SubscriberCategory::all()->random();
            },
            'deleted_by' => function () {
                return User::all()->random();
            },
            'name' => $this->faker->sentence,
            'status' => $this->faker->word,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date
        ];
    }
}