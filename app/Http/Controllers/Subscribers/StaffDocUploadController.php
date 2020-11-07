<?php

namespace App\Http\Controllers\Subscribers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\SubscriberStaffDocument;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StaffDocUploadRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Subscribers\SubscriberStaffDocResource;

class StaffDocUploadController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriber = auth()->user()->subscriber_id;
        $staffDocs = SubscriberStaffDocument::with('staff')->where('subscriber_id', '=', $subscriber)->paginate(10);
        if (!$staffDocs) {
            return $this->errorResponse('Unable to retrieve records', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Record successfully retrieved', $staffDocs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffDocUploadRequest $request)
    {
        $subscriber = auth()->user()->subscriber_id;
        $uploadPayload = $request->all();

        if ($request->hasFile('file_url')) {
            $uploadPayload['file_url'] = $request->file_url->getClientOriginalName();
            $request->file_url->storeAs('StaffDocument', $uploadPayload['file_url']);
        }

        $upload = new SubscriberStaffDocument($uploadPayload);
        $upload->subscriber_id = $subscriber;

        if (!$upload->save()) {
            return $this->errorResponse('Unable to upload document', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Upload was successfully made', new SubscriberStaffDocResource($upload), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriberStaffDocument $staffDoc)
    {
        return new SubscriberStaffDocResource($staffDoc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriberStaffDocument $staffDoc)
    {

        $url = $request->file_url;

        if ($request->hasFile('file_url')) {
            //Delete old image file and update new one
            $this->removeFile($staffDoc);

            $url['file_url'] = $request->file_url->getClientOriginalName();
            $request->file_url->storeAs('StaffDocument', $url['file_url']);
        }

        $updatedoc = $staffDoc->update($request->all());

        if (!$updatedoc) {
            return $this->errorResponse('Unable to update document', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Document successfully updated', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriberStaffDocument $staffDoc)
    {
        //delete file from storage
        $this->removeFile($staffDoc);

        $deletedoc = $staffDoc->delete();
        if (!$deletedoc) {
            return $this->errorResponse('Unable to delete document', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Document successfully deleted', null);
    }

    private function removeFile($staffDoc)
    {
        return Storage::disk('public')->delete('StaffDocument/' . $staffDoc->file_url);
    }
}