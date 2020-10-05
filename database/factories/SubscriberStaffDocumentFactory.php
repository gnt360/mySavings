<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\SubscriberStaff;
use App\Models\SubscriberStaffDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberStaffDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberStaffDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileUrl = 'http://www.fakerurl.user';
        return [
            'subscriber_id' => function () {
                return Subscriber::all()->random();
            },
            'staff_id' => function () {
                return SubscriberStaff::all()->random();
            },
            'file_name' => $this->faker->sentence,
            'file_url' => $fileUrl,
        ];
    }
}