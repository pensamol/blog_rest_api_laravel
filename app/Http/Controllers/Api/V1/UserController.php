<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function getUsers(){

        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $users
        ],200);
    }

    public function createUser(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|string',
            'password'      => 'required|string',
            'role_id'       => 'required|numeric',
            'gender_id'     => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->gender_id = $request->gender_id;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 201,
            'data' => $user
        ],201);
    }

    public function updateUser(Request $request, $id){
        
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->role_id = $request->role_id;
        $user->gender_id = $request->gender_id;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 202,
            'data' => $user
        ],202);
    }
    public function getUser($id){
        
        $user = User::find($id);
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $user
        ],200);
    }

    public function deleteUser($id){
        
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 203,
            'data' => $user
        ],203);
    }
}
