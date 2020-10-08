<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];

    public function subscriberCategory()
    {
        return $this->belongsTo(SubscriberCategory::class);
    }

    public function subscriberDetails()
    {
        return $this->hasOne(SubscriberDetail::class, 'subscriber_id');
    }

    public function subscriberAccounts()
    {
        return $this->hasMany(SubscriberAccount::class, 'subscriber_id');
    }

    public function subscriberTransactions()
    {
        return $this->hasMany(SubscriberTransaction::class, 'subscriber_id');
    }

    public function subsriberStaffs()
    {
        return $this->hasMany(SubscriberStaff::class, 'subscriber_id');
    }

    public function systemSetting()
    {
        return $this->hasOne(SystemSetting::class, 'subscriber_id');
    }

    public function smsSettings()
    {
        return $this->hasMany(SmsSetting::class, 'subscriber_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'subscriber_id');
    }

    public function subscriptionPayments()
    {
        return $this->hasMany(SubscriptionPayment::class);
    }
    public function customers()
    {
        return $this->hasMany(Customer::class, 'subscriber_id');
    }
    public function customer_documents()
    {
        return $this->hasMany(CustomerDocument::class, 'subscriber_id');
    }
    public function customer_account_types()
    {
        return $this->hasMany(CustomerAccountType::class, 'subscriber_id');
    }
    public function customer_accounts()
    {
        return $this->hasMany(CustomerAccount::class, 'subscriber_id');
    }
    public function customer_transactions()
    {
        return $this->hasMany(CustomerTransaction::class, 'subscriber_id');
    }
    public function loan_categories()
    {
        return $this->hasMany(LoanCategory::class, 'subscriber_id');
    }
    public function loans()
    {
        return $this->hasMany(Loan::class, 'subscriber_id');
    }
    public function Loan_guarantors()
    {
        return $this->hasMany(LoanGuarantor::class, 'subscriber_id');
    }
    public function Loan_collateral()
    {
        return $this->hasMany(LoanCollateral::class, 'subscriber_id');
    }
    public function Loan_repayment()
    {
        return $this->hasMany(LoanRepayment::class, 'subscriber_id');
    }
    public function Subscription_paymentHistories()
    {
        return $this->hasMany(SubscriptionPaymentHistory::class, 'subscriber_id');
    }
}