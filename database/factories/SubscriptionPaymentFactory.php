<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\SubscriptionPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscriber_id' => function () {
                return Subscriber::all()->random();
            },
            'amount' => $this->faker->numberBetween(100, 2000),
            'payment_status' => $this->faker->word,
        ];
    }
}