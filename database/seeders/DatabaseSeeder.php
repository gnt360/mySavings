<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use App\Models\SmsSetting;
use App\Models\State;
use App\Models\Subscriber;
use App\Models\SystemSetting;
use App\Models\SubscriberStaff;
use Illuminate\Database\Seeder;
use App\Models\SubscriberDetail;
use App\Models\SubscriberAccount;
use App\Models\SubscriberCategory;
use App\Models\SubscriberTransaction;
use App\Models\SubscriberStaffDocument;
use App\Models\SubscriptionPayment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        SubscriberCategory::factory(10)->create();
        Subscriber::factory(10)->create();
        User::factory(10)->create();
        SubscriberDetail::factory(10)->create();
        SubscriberAccount::factory(10)->create();
        SubscriberTransaction::factory(10)->create();
        SubscriberStaff::factory(10)->create();
        SubscriberStaffDocument::factory(10)->create();
        SystemSetting::factory(10)->create();
        SmsSetting::factory(10)->create();
        State::factory(10)->create();
        Country::factory(10)->create();
        SubscriptionPayment::factory(10)->create();
    }
}
