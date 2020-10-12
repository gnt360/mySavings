<?php

namespace App\Http\Controllers\User;

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
}