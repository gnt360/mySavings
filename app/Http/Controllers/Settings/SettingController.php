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
        if(!$subscriberSetting){
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

        $user = auth()->user()->subscriber_id;
        $settings = new SystemSetting();

        $settings->subscriber_id = $user;
        $settings->display_name = $request->display_name;
        $settings->footer = $request->footer;
        $settings->website_url = $request->website_url;
        $settings->logo = $request->file('logo')->store('logos');
        $settings->contact_number = $request->contact_number;
        $settings->contact_email = $request->contact_email;

        if(!$settings->save()){
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

        if(!$showSetting){
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

        // delete the subscriber old log;
       // $this->deleteLogo();
        $updateSettings = $setting->update($request->all());

        if(!$updateSettings){
            return $this->errorResponse('Unable to update changes', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Settings successfully updated', null);
    }

    private function deleteLogo()
    {
        if (auth()->user()->logo) {
            Storage::disk('public')->delete('logos/' . auth()->user()->logo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSetting $setting)
    {
        $setting->delete();
        return $this->successResponse('Successfully deleted');
    }
}