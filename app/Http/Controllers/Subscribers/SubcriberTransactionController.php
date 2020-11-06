<?php

namespace App\Http\Controllers\Subscribers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SubscriberAccount;
use App\Models\SubscriberTransaction;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\SubscriberDepositeRequest;
use App\Http\Requests\SubscriberWithdrawalRequest;
use App\Http\Resources\Subscribers\SubscriberDepositResource;
use App\Http\Resources\Subscribers\SubscriberWithdrawalResource;

class SubcriberTransactionController extends BaseController
{
    public function deposit(SubscriberDepositeRequest $request)
    {
        $subscriber = auth()->user()->subscriber_id;
        $deposit = new SubscriberTransaction();
        $deposit->subscriber_id = $subscriber;
        $deposit->account_id = $request->account_id;
        $deposit->deposit = $request->deposit;
        $deposit->account_balance = $request->deposit + $deposit->withdrawal;

        $deposit->description = $request->description;
        $deposit->save();

        $balance = SubscriberAccount::where('id', '=', $deposit->account_id)->first();
        $balance->credit_balance = $request->deposit +  $balance->credit_balance;
        $balance->current_balance = $balance->credit_balance - $balance->debit_balance;
        $balance->save();

        if (!$deposit) {
            return $this->errorResponse('Unable to make Deposit', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Your deposit was successfully made', new SubscriberDepositResource($deposit));
    }

    public function withdrawal(SubscriberWithdrawalRequest $request)
    {
        $subscriber = auth()->user()->subscriber_id;
        $withdrawal = new SubscriberTransaction();
        $withdrawal->subscriber_id = $subscriber;
        $withdrawal->account_id = $request->account_id;
        $withdrawal->withdrawal = $request->withdrawal;
        $withdrawal->account_balance = $request->deposit + $withdrawal->withdrawal;
        $withdrawal->description = $request->description;

        $balance = SubscriberAccount::where('id', '=', $withdrawal->account_id)->first();
        if ($request->withdrawal > $balance->current_balance) {
            return $this->errorResponse('Insufficient Found', Response::HTTP_NOT_ACCEPTABLE);
        }

        $balance->debit_balance = $request->withdrawal +  $balance->debit_balance;
        $balance->current_balance = $balance->credit_balance - $balance->debit_balance;
        $balance->save();

        if (!$withdrawal->save()) {
            return $this->errorResponse('Unable to make withdrawal', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Your withdrawal was successfully made', new SubscriberWithdrawalResource($withdrawal));
    }

    public function allTransactions()
    {
        $subscriber = auth()->user()->subscriber_id;
        $transactions = SubscriberTransaction::where('subscriber_id', '=', $subscriber)->latest()->orderBy('created_at', 'desc')->paginate(10);
        if (!$transactions) {
            return $this->errorResponse('Unable to retrieve transactions', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Record successfully retrieved', $transactions);
    }

    public function dailyTransactions()
    {
        $subscriber = auth()->user()->subscriber_id;
        $date   = Carbon::now()->today();
        $dailyTrans = SubscriberTransaction::where('subscriber_id', '=', $subscriber)->whereDate('created_at',  $date)->latest('created_at', 'desc')->paginate(10);

        if (!$dailyTrans) {
            return $this->errorResponse('Unable to get daily records', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Daily transaction successfuly retrieved', $dailyTrans);
    }

    public function weeklyTransactions()
    {
        $subscriber = auth()->user()->subscriber_id;
        $date = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
        $weeklyTrans = SubscriberTransaction::where('subscriber_id', '=', $subscriber)->whereBetween('created_at',  $date)->latest('created_at', 'desc')->paginate(10);

        if (!$weeklyTrans) {
            return $this->errorResponse('Unable to get weekly records', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('weekly transaction successfuly retrieved', $weeklyTrans);
    }

    public function monthlyTransactions()
    {
        $subscriber = auth()->user()->subscriber_id;
        $date   = Carbon::now()->month;
        $monthlyTrans = SubscriberTransaction::where('subscriber_id', '=', $subscriber)->whereMonth('created_at',  $date)->latest('created_at', 'desc')->paginate(10);

        if (!$monthlyTrans) {
            return $this->errorResponse('Unable to get monthly records', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('monthly transaction successfuly retrieved', $monthlyTrans);
    }
}