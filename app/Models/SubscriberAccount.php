<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberAccount extends Model
{
    use HasFactory, UsesUuid;

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}