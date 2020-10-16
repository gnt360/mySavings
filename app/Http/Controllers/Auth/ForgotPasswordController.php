<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends BaseController
{


    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }


    protected function credentials(Request $request)
    {
        return $request->only('email');
    }


    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetLinkResponse()
    {
        return $this->successResponse('We have emailed your password reset link!', null);
    }


    protected function sendResetLinkFailedResponse()
    {
       return $this->errorResponse('Sorry, We cant find this email address on our database.', Response::HTTP_NOT_FOUND);
    }
     /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}