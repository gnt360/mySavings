<?php

namespace App\Models;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccountType extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
    
    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class, 'account_type_id');
    }
}
