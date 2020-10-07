<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\SubscriberAccount;
use App\Models\SubscriberTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberTransaction::class;

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
            'account_id' => function () {
                return SubscriberAccount::all()->random();
            },
            'created_by' => function () {
                return User::all()->random();
            },
            'deleted_by' => function () {
                return User::all()->random();
            },
            'modified_by' => function () {
                return User::all()->random();
            },
            'deposit' => $this->faker->numberBetween(100, 1000),
            'withdrawal' => $this->faker->numberBetween(100, 1000),
            'account_balance' => $this->faker->numberBetween(100, 2000),
            'description' => $this->faker->text
        ];
    }
}