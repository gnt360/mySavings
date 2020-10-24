<?php

namespace App\Http\Controllers\SubscriberCategory;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SubscriberCategoryRequest;
use App\Http\Resources\Subscribers\SubscriberCategoryResource;
use App\Models\SubscriberCategory;
use Symfony\Component\HttpFoundation\Response;

class CreateSubscriberCategoryController extends BaseController
{
    public function store(SubscriberCategoryRequest $request)
    {
        $category = new SubscriberCategory();
        $category->name = $request->name;
        $category->reg_amount = $request->reg_amount;
        $category->discount = $request->discount;

        if(!$category->save()){
            return $this->errorResponse('Unable to create a category', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Successfully created', new SubscriberCategoryResource($category) , Response::HTTP_CREATED);

    }
}