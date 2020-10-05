<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberDetail extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function systemSetting()
    {
        return $this->belongsTo(SystemSetting::class, 'detail_id');
    }
}