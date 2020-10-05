<?php

namespace Database\Factories;

use App\Models\SmsSetting;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmsSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SmsSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $apiUrl = 'https://www.mysavingsmsgateway.com/api/v1/sms/create';
        return [
            'subscriber_id' => function () {
                return Subscriber::all()->random();
            },
            'sms_gateway' => $this->faker->text,
            'username' => $this->faker->name,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'api' => $apiUrl
        ];
    }
}