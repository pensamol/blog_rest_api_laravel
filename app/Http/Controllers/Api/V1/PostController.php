<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
    public function getPosts() {

        $posts = Post::all();

        // return PostResource::collection($posts);
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $posts
        ],200);
    }

    public function createPost(Request $request) {

        $imagePath = "assets/uploads/images/posts";
        if(!empty($request->image)){
            $fileName = $imagePath . time() . "-" . Str::slug($request->title) . "-" . $request->image->getClientOriginalName();
        }
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->sub_category_id;
        $post->post_by = $request->post_by;
        if(!empty($request->image)){
            $post->image = $fileName;
            $request->image->move(public_path($imagePath), $fileName);
        }
        // $post->image = $request->image;
        $post->save();
        return response()->json([
                'success' => true,
                'message' => "ok",
                'status_code' => 201,
                'data' => $post
            ],201); 
    }

    public function updatePost(Request $request, $id) {

        $imagePath = "assets/uploads/images/posts";
        if(!empty($request->image)){
            $fileName = $imagePath . time() . "-" . Str::slug($request->title) . "-" . $request->image->getClientOriginalName();
        }
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->sub_category_id;
        $post->post_by = $request->post_by;
        if(!empty($request->image)){
            $post->image = $fileName;
            $request->image->move(public_path($imagePath), $fileName);
        }
        // $post->image = $request->image;
        $post->save();
        return response()->json([
                'success' => true,
                'message' => "ok",
                'status_code' => 202,
                'data' => $post
            ],202); 
    }

    public function getPost($id) {

        $post = Post::find($id);
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $post
        ],200);
    }
    public function deletePost($id) {

        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 203,
            'data' => $post
        ],203);
    }

}
