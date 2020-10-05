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
}