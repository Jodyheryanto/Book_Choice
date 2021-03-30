<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        if(sizeof($users) == 0){
            return response()->json([
                "message" => "No user records here."
            ], 404);
        }else{
            return response()->json([
                "message" => "Get user records success.",
                "users" => $users
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request = $request->only(['username','fullname','email','password','avatar']);
        $rules = [
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $role2 = \App\Role::find(2);

        $validator = Validator::make($request, $rules);
        if($validator->fails()){
            return response()->json([
                "message" => "Insert user failed.",
                "error" => $validator->errors()
            ], 400);
        } else {
            $user = new User($request);
            $role2->users()->save($user);
            return response()->json([
                "message" => "Insert user success.",
                "user" => $user
            ], 201);
        }
    }

    public function show($id)
    {
        $user = User::where('id', $id)->get();
        if (sizeof($user) == 0) {
            return response()->json([
                "message" => "User record not found."
            ], 404);
        } else {
            return response()->json([
                "message" => "Get user record success.",
                "user" => $user
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['fullname','email','password','avatar']);
        $user = User::find($id);
        if($user){
            $rules = [
                'fullname' => 'required_without_all:email,password,avatar',
                'email' => 'required_without_all:fullname,password,avatar|email',
                'password' => 'required_without_all:fullname,email,avatar',
                'avatar' => 'required_without_all:fullname,email,password',
            ];
            $validator = Validator::make($request, $rules);
            if($validator->fails()){
                return response()->json([
                    "message" => "Update user failed.",
                    "error" => $validator->errors()
                ], 400);
            }else{
                $user->update($request);
                return response()->json([
                    "message" => "Update user success.",
                    "user" => $user,
                ], 200);
            }
        }else{
            return response()->json([
                "message" => "User record not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
            return response()->json([
                    "message" => "Delete user success.",
                    "deleted_data" => $user
                ]
                , 200);
        } else {
            return response()->json([
                "message" => "User record not found."
            ], 404);
        }
    }
}
