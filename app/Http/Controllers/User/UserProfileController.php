<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\User\ProfileResource;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends BaseController
{
    public function show()
    {
        $user = auth()->user();
        if(!$user){
            return $this->errorResponse('Unable to retrieve profile.', Response::HTTP_BAD_REQUEST);
        }

        return $this->successResponse('profile successfully retrieved', new ProfileResource($user));
    }

      public function logOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse('You have been successfully logged out!');
    }
}
