<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\SubscriberAccount;
use App\Models\SubscriberCategory;
use App\Models\SubscriberDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        SubscriberCategory::factory(10)->create();
        Subscriber::factory(10)->create();
        SubscriberDetail::factory(10)->create();
        SubscriberAccount::factory(10)->create();
    }
}