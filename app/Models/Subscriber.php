<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriberCategory()
    {
        return $this->belongsTo(SubscriberCategory::class);
    }

    public function subscriberDetails()
    {
        return $this->hasOne(SubscriberDetail::class, 'subscriber_id');
    }

    public function subscriberAccounts()
    {
        return $this->hasMany(SubscriberAccount::class, 'subscriber_id');
    }

    public function subscriberTransactions()
    {
        return $this->hasMany(SubscriberTransaction::class, 'subscriber_id');
    }

    public function subsriberStaffs()
    {
        return $this->hasMany(SubscriberStaff::class, 'subscriber_id');
    }

    public function systemSetting()
    {
        return $this->hasOne(SystemSetting::class, 'subscriber_id');
    }
}