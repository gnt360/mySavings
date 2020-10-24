<?php

namespace App\Http\Controllers\SubscriberCategory;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Subscribers\SubscriberCategoryResource;
use App\Models\SubscriberCategory;
use Symfony\Component\HttpFoundation\Response;

class GetSubscriberCategoryController extends BaseController
{
    public function show(SubscriberCategory $category)
    {
        $categoryData = new SubscriberCategoryResource($category);

        if(!$categoryData){
            return $this->errorResponse('Data not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse('Data successfully retrieved', $categoryData);
    }
}