<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SubscriberAccountRequest;
use App\Http\Resources\Subscribers\SubscriberAccountResource;
use App\Models\SubscriberAccount;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriberAccountController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriber = auth()->user()->subscriber_id;
        $accountData = SubscriberAccount::where('subscriber_id', '=', $subscriber)->get();
        if (!$accountData) {
            return $this->errorResponse('Account Data not found', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse('Account record successfully retrieved', SubscriberAccountResource::collection($accountData));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberAccountRequest $request)
    {
        $subscriber = auth()->user()->subscriber_id;
        $accountPayload = $request->all();
        $account = new SubscriberAccount($accountPayload);
        $account->subscriber_id = $subscriber;
        $account->save();

        if (!$account) {
            return $this->errorResponse('Unable to add account Details', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Account successfully added', new SubscriberAccountResource($account), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriberAccount $subscriberAccount)
    {
        $accountData = new SubscriberAccountResource($subscriberAccount);
        if (!$accountData) {
            return $this->errorResponse('Unable to show record', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Record successful', $accountData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriberAccount $subscriberAccount)
    {
        $updateAccount = $subscriberAccount->update($request->all());
        if (!$updateAccount) {
            return $this->errorResponse('Unable to update Record', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Account updated succssfully', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriberAccount $subscriberAccount)
    {
        $deleateData = $subscriberAccount->delete();

        if (!$deleateData) {
            return $this->errorResponse('Unable to delete Record', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Account successfully deleted', null);
    }
}