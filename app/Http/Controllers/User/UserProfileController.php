<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProfilePictureRequest;
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

     public function profilePicture(ProfilePictureRequest $request)
    {
        if (!$request->hasFile('image_url')) {
            return $this->errorResponse('Please select a photo to upload.', Response::HTTP_BAD_REQUEST);
        }

        $fileName = time() + 1 . '.' . $request->image_url->extension();

        // delete the user's old profile photo
        $this->deleteOldPicture();

        // save the photo to the local storage
        $request->image_url->storeAs('images', $fileName, 'public');
        auth()->user()->update(['image_url' => $fileName]);

        // validating successful uploads
        if (!$request->file('image_url')->isValid()) {
            return $this->errorResponse('Unable to upload photo', Response::HTTP_BAD_REQUEST);
        }

        return $this->successResponse('Profile photo uploaded successfully.', null);
    }

    /**
     * delete old image
     */
    private function deleteOldPicture()
    {
        if (auth()->user()->image_url) {
            Storage::disk('public')->delete('images/' . auth()->user()->image_url);
        }
    }

      public function logOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse('You have been successfully logged out!');
    }
}
