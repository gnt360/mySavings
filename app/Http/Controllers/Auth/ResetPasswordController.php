<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends BaseController
{

    public function reset(ResetPasswordRequest $request)
    {

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }


    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }


    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        //event(new PasswordReset($user));

        // $this->guard()->login($user);
    }

    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }


    protected function sendResetResponse()
    {
        return $this->successResponse('Password reset successful', null);
    }

    protected function sendResetFailedResponse()
    {
        return $this->errorResponse('Sorry, We cant find this email address on our database.', Response::HTTP_NOT_FOUND);
    }


     public function broker()
    {
        return Password::broker();
    }



}