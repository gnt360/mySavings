<?php

namespace App\Http\Controllers\SubscriberCategory;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Subscribers\SubscriberCategoryResource;
use App\Models\SubscriberCategory;
use Symfony\Component\HttpFoundation\Response;

class AllSubscriberCategoryController extends BaseController
{
    public function index()
    {
        $categories = SubscriberCategory::latest()->orderBy('created_at')->get();

        if(!$categories){
            return $this->errorResponse('Unable to retrive records', Response::HTTP_BAD_REQUEST);
        }

        return $this->successResponse('Record successfully retrived', SubscriberCategoryResource::collection($categories));
    }
}