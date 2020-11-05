<?php

namespace App\Http\Controllers\Subscribers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubscriberStaff;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffLoginCredentialsMail;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Subscribers\StaffResource;

class StaffController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->subscriber_id;

        $subscriberStaff = SubscriberStaff::where('subscriber_id', '=', $user)->latest()->orderBy('created_at', 'desc')->paginate(10);

        if (!$subscriberStaff) {
            return $this->errorResponse('Unable to retrieve staff record', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Record successfully retrieved', $subscriberStaff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $subscriber = auth()->user()->subscriber_id;
        $staffPayload = $request->all();
        $staff = new SubscriberStaff($staffPayload);
        $staff->subscriber_id = $subscriber;
        $staff->save();

        //generate a password for the new staff

        $password = Str::random(8);

        $user = new User();
        $user->subscriber_id = $subscriber;
        $user->user_name = $staff->email;
        $user->id =  $staff->id;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user->email)->send(new StaffLoginCredentialsMail($user, $password));

        if (!$staff->save() && !$user->save()) {
            return $this->errorResponse('Unable to create staff', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Staff Successfully created', new StaffResource($staff), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriberStaff $staff)
    {
        $staffData = new StaffResource($staff);
        if (!$staffData) {
            return $this->errorResponse('Unable to retrieve staff', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Staff successfully retrieved', $staffData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriberStaff $staff)
    {
        $updateStaff = $staff->update($request->all());
        if (!$updateStaff) {
            return $this->errorResponse('Unable to update staff Record', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Staff successfully updated', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriberStaff $staff)
    {
        return $staff->delete();
    }

    public function activateStaff($staff)
    {
        $activateStaff = User::findOrFail($staff);
        $activateStaff->status = true;
        $activateStaff->save();

        if (!$activateStaff) {
            return $this->errorResponse('Unable to activate staff status', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Staff Successfully activated', null);
    }

    public function deactivateStaff($staff)
    {
        $activateStaff = User::findOrFail($staff);
        $activateStaff->status = false;
        $activateStaff->save();

        if (!$activateStaff) {
            return $this->errorResponse('Unable to deactivate staff status', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Staff Successfully deactivated', null);
    }
}