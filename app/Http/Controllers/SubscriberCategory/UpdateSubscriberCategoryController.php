<?php

namespace App\Http\Controllers\SubscriberCategory;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Subscribers\SubscriberCategoryResource;
use App\Models\SubscriberCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubscriberCategoryController extends BaseController
{
    public function update(SubscriberCategory $category, Request $request)
    {
        $updateCategory = $category->update($request->all());

        if(!$updateCategory){
            return $this->errorResponse('Unable to update category', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Category successfully updated',new SubscriberCategoryResource($category));
    }
}