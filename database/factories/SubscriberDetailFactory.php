<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\SubscriberDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $facebookUrl = 'http://www.facebook.com';
        $intagramUrl = 'https://www.instagram.com';
        $twitterUrl = 'https://www.twitter.com';
        return [
            'subscriber_id' => function () {
                return Subscriber::all()->random();
            },
            'created_by' => function () {
                return User::all()->random();
            },
            'modified_by' => function () {
                return User::all()->random();
            },
            'address1' => $this->faker->address,
            'address2' => $this->faker->address,
            'postal_code' => $this->faker->numberBetween(4, 5),
            'telephone' => $this->faker->phoneNumber,
            'mobile_number' => $this->faker->phoneNumber,
            'email1' => $this->faker->unique()->safeEmail,
            'state_code' => $this->faker->numberBetween(4, 5),
            'facebook' => $facebookUrl,
            'instagram' => $intagramUrl,
            'twitter' => $twitterUrl,
        ];
    }
}