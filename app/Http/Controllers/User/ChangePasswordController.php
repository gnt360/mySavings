<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Symfony\Component\HttpFoundation\Response;


class ChangePasswordController extends BaseController
{
     public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        if (!(Hash::check($request->get('old_password'), $request->user()->password))) {
            // The passwords not matches
             return $this->errorResponse('Your Old password does not match with the password provided. Please check again', Response::HTTP_UNAUTHORIZED);
        }
        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            //Check if Current password and new password are same
             return $this->errorResponse('You have used this password before. Try a new one!', Response::HTTP_UNAUTHORIZED);

        }
            $user->password = Hash::make($request->new_password);
            $user->save();
            return $this->successResponse('Password changed successfully.', null);
    }
}