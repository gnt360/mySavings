<?php

namespace App\Models;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
    public function customer_account_type()
    {
        return $this->belongsTo(CustomerAccountType::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
