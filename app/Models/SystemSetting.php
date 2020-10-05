<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriberDetails()
    {
        return $this->belongsTo(SubscriberDetail::class);
    }
}