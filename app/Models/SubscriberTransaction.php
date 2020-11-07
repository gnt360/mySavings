<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberTransaction extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function subscriberAccount()
    {
        return $this->belongsTo(SubscriberAccount::class, 'account_id');
    }
}