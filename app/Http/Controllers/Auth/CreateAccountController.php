<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Resources\Account\SubscriberAccountResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CreateAccountController extends BaseController
{
    public function createAccount(CreateAccountRequest $request)
    {
        $subscriber = new Subscriber();
        $subscriber->category_id = $request->category_id;
        $subscriber->name = $request->name;
        $subscriber->status = 'unpaid';
        $subscriber->save();

        $user = new User();
        $user->subscriber_id = $subscriber->id;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if(!$subscriber->save() && !$user->save()){
            return $this->errorResponse('Unable to create account, please try again', Response::HTTP_INTERNAL_SERVER_ERROR);
        }



        //send user notification after register
        $user->sendEmailVerificationNotification();

        return $this->successResponse('Account successfully created, please check your email to verify your account', new SubscriberAccountResource($user), Response::HTTP_CREATED);

    }
}