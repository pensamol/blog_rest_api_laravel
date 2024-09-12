<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
class SubCategoryController extends Controller
{
    public function getSubCategories() {
        $subCategories = SubCategory::with('category')->get();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $subCategories
        ],200);
    }

    public function createSubCategory(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:sub_categories',
            'category_id'    => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }

       $subCategory = new SubCategory();
       $subCategory->name = $request->name;
       $subCategory->category_id = $request->category_id;
       $subCategory->save();
       return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 201,
            'data' => $subCategory
        ],201);
    }

    public function getSubCategory($id) {
        $subCategory = SubCategory::find($id);
        return response()->json([
             'success' => true,
             'message' => "ok",
             'status_code' => 200,
             'data' => $subCategory
         ],200);
     }

    public function updateSubCategory(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:sub_categories',
            'name'    => 'required|string',
            'category_id'    => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }

        
        $subCategory = SubCategory::find($id);
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();
        return response()->json([
             'success' => true,
             'message' => "ok",
             'status_code' => 202,
             'data' => $subCategory
         ],202);
     }
    public function deleteSubCategory($id) {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return response()->json([
             'success' => true,
             'message' => "ok",
             'status_code' => 203,
             'data' => $subCategory
         ],203);
     }
}
