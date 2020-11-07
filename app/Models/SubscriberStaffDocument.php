<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberStaffDocument extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function staff()
    {
        return $this->belongsTo(SubscriberStaff::class);
    }
}