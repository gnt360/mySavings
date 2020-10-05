<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberAccount extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function subscriberTransactions()
    {
        return $this->hasMany(SubscriberTransaction::class, 'account_id');
    }
}