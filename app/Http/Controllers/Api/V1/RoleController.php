<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function getRoles() {
       $roles = Role::all();
       return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $roles
        ],200);
    }


    public function createRole(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:roles'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 201,
            'data' => $role
        ],201);
    }

    public function getRole($id) {

        $role = Role::find($id);
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 200,
            'data' => $role
        ],200);
    }

    public function updateRole(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|unique:roles'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "no",
                'status_code' => 401,
                'data' => $validator->errors()
            ],401);
        }
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 202,
            'data' => $role
        ],202);
    }

    public function deleteRole($id) {

        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'success' => true,
            'message' => "ok",
            'status_code' => 203,
            'data' => $role
        ],203);
    }
}
