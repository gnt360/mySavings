<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use App\Models\SubscriberStaff;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberStaff::class;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address1' => $this->faker->address,
            'address2' => $this->faker->address,
            'city' => $this->faker->city,
            'state_code' => $this->faker->numberBetween(10, 20),
            'country_code' => $this->faker->countryCode,
            'created_by' => Str::uuid(),
            'modified_by' => Str::uuid()
        ];
    }
}