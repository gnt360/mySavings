<?php

namespace App\Http\Controllers\SubscriberCategory;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\SubscriberCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteSubscriberCategoryController extends BaseController
{
    public function destroy(SubscriberCategory $category)
    {
        $deleteCategory = $category->delete();

        if(!$deleteCategory){
            return $this->errorResponse('Unable to delete category', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('category successfully removed', null);
    }
}