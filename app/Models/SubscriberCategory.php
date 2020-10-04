<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriberCategory extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'category_id');
    }
}