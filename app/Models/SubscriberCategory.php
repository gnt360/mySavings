<?php

namespace App\Models;

use DateTimeInterface;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriberCategory extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'category_id');
    }
}