<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Http\Resources\Account\LoginResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $checkIfUserIsVerified = User::where('user_name', $request->user_name)
            ->where('email_verified_at', '<>', NULL)->first();

        if (!$checkIfUserIsVerified) {
            return $this->errorResponse('Account not verified', Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('user_name', $request->user_name)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'user_name' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->status == false) {
            return $this->errorResponse('Sorry you have been deactivated from this service', Response::HTTP_UNAUTHORIZED);
        }

        //return $user->createToken('ApiAuthentication')->plainTextToken;

        $token = $user->createToken('Apiauthentication');
        $user->token = $token->plainTextToken;
        return $this->successResponse('Successfully logged in', new LoginResource($user));
    }
}