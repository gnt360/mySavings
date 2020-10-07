<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\SubscriberDetail;
use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SystemSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $websiteUrl = 'https://www.mysavings.com.ng';
        return [
            'subscriber_id' => function () {
                return Subscriber::all()->random();
            },           

            'display_name' => $this->faker->sentence,
            'footer' => $this->faker->text,
            'website_url' => $websiteUrl,
            'contact_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->companyEmail,
            'map' => $this->faker->macAddress,
            'sms_charges' => $this->faker->numberBetween(1, 3)
        ];
    }
}