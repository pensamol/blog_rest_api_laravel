<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function getCategories(){
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $categories
        ],200);
    }

    public function newCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:categories'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 201,
            'data' => $category
        ],201);
    }

    public function updateCategory(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:categories'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 202,
            'data' => $category
        ],202);
    }
    public function deleteCategory($id){

        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 203,
            'data' => $category
        ],203);
    }
    public function getCategory($id){

        $category = Category::find($id);
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $category
        ],200);
    }
}
