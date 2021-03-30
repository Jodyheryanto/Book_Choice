<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestBook;
use Validator;

class GuestBookController extends Controller
{
    public function index()
    {
        $guestbooks = GuestBook::get();
        if(sizeof($guestbooks) == 0){
            return response()->json([
                "message" => "No guestbook records here"
            ], 404);
        }else{
            return response()->json([
                "message" => "Get guestbook records success",
                "guestbook" => $guestbooks
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request = $request->only(['guest_name','guest_message','job','company','email']);
        $rules = [
            'guest_name' => 'required',
            'guest_message' => 'required',
            'email' => 'required|email',
            'job' => 'required',
            'company' => 'required',
        ];

        $validator = Validator::make($request, $rules);
        if($validator->fails()){
            return response()->json([
                "message" => "Insert guestbook failed",
                "error" => $validator->errors()
            ], 400);
        } else {
            $guestbook = GuestBook::create($request);
            return response()->json([
                "message" => "Insert guestbook success.",
                "guestbook" => $guestbook
            ], 201);
        }
    }

    public function show($id)
    {
        $guestbook = GuestBook::where('id', $id)->get();
        if (sizeof($guestbook) == 0) {
            return response()->json([
                "message" => "Guestbook record not found."
            ], 404);
        } else {
            return response()->json([
                "message" => "Get guestbook record success.",
                "guestbook" => $guestbook
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['guest_name','guest_message','job','company','email']);
        $guestbook = GuestBook::find($id);
        if($guestbook){
            $rules = [
                'guest_name' => 'required_without_all:guest_message,email,job,company',
                'guest_message' => 'required_without_all:guest_name,email,job,company',
                'email' => 'email|required_without_all:guest_name,guest_message,job,company',
                'job' => 'required_without_all:guest_name,email,guest_message,company',
                'company' => 'required_without_all:guest_name,email,guest_message,job',
            ];
            $validator = Validator::make($request, $rules);
            if($validator->fails()){
                return response()->json([
                    "message" => "Update guestbook failed.",
                    "error" => $validator->errors(),
                ], 400);
            }else{
                $guestbook->update($request);
                return response()->json([
                    "message" => "Update guestbook success.",
                    "guestbook" => $guestbook,
                ], 200);
            }
        }else{
            return response()->json([
                "message" => "Guestbook record not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $guestbook = GuestBook::find($id);
        if($guestbook) {
            $guestbook->delete();
            return response()->json([
                    "message" => "Delete guestbook success.",
                    "deleted_data" => $guestbook
                ]
                , 200);
        } else {
            return response()->json([
                "message" => "Guestbook record not found."
            ], 404);
        }
    }
}
