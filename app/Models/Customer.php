<?php

namespace App\Models;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
    public function customer_documents()
    {
        return $this->hasMany(CustomerDocument::class, 'customer_id');
    }
    public function customer_account()
    {
        return $this->hasOne(CustomerAccount::class, 'id');
    }
    public function customer_transactions()
    {
        return $this->hasMany(CustomerTransaction::class, 'customer_id');
    }
    public function loans()
    {
        return $this->hasMany(Loan::class, 'customer_id');
    }
}
