<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\SubscriberAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberAccount::class;

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
            'created_by' => function () {
                return User::all()->random();
            },
            'deleted_by' => function () {
                return User::all()->random();
            },
            'modified_by' => function () {
                return User::all()->random();
            },            
            'account_type' => $this->faker->bankAccountNumber,
            'account_name' => $this->faker->name
            
        ];
    }
}