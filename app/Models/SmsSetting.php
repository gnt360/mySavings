<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscribers()
    {
        return $this->belongsTo(Subscriber::class);
    }
}