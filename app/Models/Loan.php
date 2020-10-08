<?php

namespace App\Models;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded = [];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
    public function loan_category()
    {
        return $this->belongsTo(LoanCategory::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Loan_collateral()
    {
        return $this->hasMany(LoanCollateral::class, 'loan_id');
    }
    public function Loan_repayment()
    {
        return $this->hasMany(LoanRepayment::class, 'loan_id');
    }
}
