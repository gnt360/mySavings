<?php

namespace App\Http\Controllers\Subscribers;

use Carbon\Carbon;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\SubscriptionPaymentHistory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\SubscriberSubscriptionRequest;
use App\Http\Resources\Subscribers\SubscriberResource;
use App\Http\Resources\Subscribers\SubscriptionDetailsResource;
use App\Models\SubscriberDetail;

class SubscriberController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user()->subscriber_id;
        $subscriber = Subscriber::where('id', '=', $user)->get();

       if(!$subscriber){
           return $this->errorResponse('No records found', Response::HTTP_NOT_FOUND);
       }

       return $this->successResponse('Records successfully retrieved', SubscriberResource::collection($subscriber));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        $subscriberDetails = new SubscriptionDetailsResource ($subscriber);

        if(!$subscriberDetails){
            return $this->errorResponse('Unable to view subscription', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Successsfull', $subscriberDetails);
    }

    public function updateDetails(Request $request)
    {
       $user = auth()->user()->subscriber_id;

       if(!SubscriptionPaymentHistory::where('subscriber_id', '=', $user)->exists()){
           return $this->errorResponse('You must make payment before updating your details', Response::HTTP_UNAUTHORIZED);
       }

       $subscriber = SubscriberDetail::firstOrNew();
       $subscriber->subscriber_id = $user;
       $subscriber->address1 = $request->address1;
       $subscriber->address2 = $request->address2;
       $subscriber->postal_code = $request->postal_code;
       $subscriber->telephone = $request->telephone;
       $subscriber->mobile_number = $request->mobile_number;
       $subscriber->email1 = $request->email1;
       $subscriber->email2 = $request->email2;
       $subscriber->state_code = $request->state_code;
       $subscriber->facebook = $request->facebook;
       $subscriber->instagram = $request->instagram;
       $subscriber->twitter = $request->twitter;
       $subscriber->save();

       if(!$subscriber->save()){
           return $this->errorResponse('Unable to update details', Response::HTTP_INTERNAL_SERVER_ERROR);
       }
       return $this->successResponse('Details successfully updated', null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscriberSubscription(SubscriberSubscriptionRequest $request)
    {
        $user = auth()->user()->subscriber_id;
        $subscription = Subscriber::where('id', '=', $user)->first();
        $subscription->category_id = $request->category_id;
        $subscription->status = 'paid';
        $subscription->start_date = now();
        $subscription->end_date = Carbon::now()->addDays(365);
        $subscription->active_status = true;


        $subHistotry = SubscriptionPaymentHistory::firstOrNew();
        $subHistotry->subscriber_id = $user;
        $subHistotry->amount_paid = $request->reg_amount;
        $subHistotry->date_paid = now();
        $subHistotry->status = 'success';
        $subHistotry->description = $request->description;
        $subHistotry->save();

        if(!$subscription->save()){
            return $this->errorResponse('subscription failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Your subscription was succssfull', new SubscriberResource($subscription));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}