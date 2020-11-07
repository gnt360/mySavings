<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Settings\SettingResource;

class SettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user()->subscriber_id;
        $subscriberSetting = SystemSetting::where('subscriber_id', '=', $user)->get();
        if (!$subscriberSetting) {
            return $this->errorResponse('Unable to display Settings', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Setting successfully displayed', SettingResource::collection($subscriberSetting));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {

        $subscriber = auth()->user()->subscriber_id;
        $payload = $request->all();

        if ($request->hasFile('logo')) {
            $payload['logo'] = time() + 1 . '.' . $request->logo->extension();
            $request->logo->storeAs('logos', $payload['logo']);
        }
        $settings = new SystemSetting($payload);
        $settings->subscriber_id = $subscriber;

        if (!$settings->save()) {
            return $this->errorResponse('unable to create system settings, try again', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Successfully created', new SettingResource($settings), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSetting $setting)
    {
        $showSetting = new SettingResource($setting);

        if (!$showSetting) {
            return $this->errorResponse('Unable to show settings', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse('Setting successfully retrieved',  $showSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemSetting $setting)
    {

        $logo = $request->logo;

        if ($request->hasFile('logo')) {
            // delete the subscriber old logo and update new one;
            $this->deleteLogo($setting);
            $logo['logo'] = time() + 1 . '.' . $request->logo->extension();
            $request->logo->storeAs('logos', $logo['logo']);
        }
        $updateSettings = $setting->update($request->all());

        if (!$updateSettings) {
            return $this->errorResponse('Unable to update changes', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Settings successfully updated', null);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSetting $setting)
    {
        //Remove logo from file if settings is deleted
        $this->deleteLogo($setting);

        $setting->delete();
        return $this->successResponse('Successfully deleted');
    }

    private function deleteLogo($setting)
    {
        return Storage::disk('public')->delete('logos/' . $setting->logo);
    }
}