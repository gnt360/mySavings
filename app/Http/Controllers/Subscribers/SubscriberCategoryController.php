<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\SubscriberCategory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\SubscriberCategoryRequest;
use App\Http\Resources\Subscribers\SubscriberCategoryResource;

class SubscriberCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories = SubscriberCategory::latest()->orderBy('created_at')->get();

        if(!$categories){
            return $this->errorResponse('Unable to retrive records', Response::HTTP_BAD_REQUEST);
        }

        return $this->successResponse('Record successfully retrived', SubscriberCategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriberCategory $category)
    {
         $categoryData = new SubscriberCategoryResource($category);

        if(!$categoryData){
            return $this->errorResponse('Data not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse('Data successfully retrieved', $categoryData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriberCategory $category, Request $request)
    {

        $updateCategory = $category->update($request->all());

        if(!$updateCategory){
            return $this->errorResponse('Unable to update category', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Category successfully updated',new SubscriberCategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriberCategory $category)
    {
         $deleteCategory = $category->delete();

        if(!$deleteCategory){
            return $this->errorResponse('Unable to delete category', Response::HTTP_BAD_REQUEST);
        }

        return $this->successResponse('Category successfully removed', null);
    }
}
