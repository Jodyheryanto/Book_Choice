<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

use Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::get();
        if(sizeof($reviews) == 0){
            return response()->json([
                "message" => "No review records here."
            ], 404);
        }else{
            return response()->json([
                "message" => "Get review record success",
                "review" => $reviews
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request = $request->only(['user_id','book_id','post','is_positive','rating']);
        $rules = [
            'user_id' => 'integer',
            'book_id' => 'required|integer',
            'post' => 'required',
            'is_positive' => 'required|integer|min:0|max:1',
            'rating' => 'required|integer|min:1|max:5',
        ];

        $validator = Validator::make($request, $rules);
        if($validator->fails()){
            return response()->json([
                "message" => "Insert review failed.",
                "error" => $validator->errors()
            ], 400);
        } else {
            $review = Review::create($request);
            return response()->json([
                "message" => "Insert review success.",
                "review" => $review
            ], 201);
        }
    }

    public function show($id)
    {
        $review = Review::where('id', $id)->get();
        if (sizeof($review) == 0) {
            return response()->json([
                "message" => "Review record not found."
            ], 404);
        } else {
            return response()->json([
                "message" => "Get review record success.",
                "review" => $review
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['post','is_positive','rating']);
        $review = Review::find($id);
        if($review){
            $rules = [
                'post' => 'required_without_all:caption,image_path',
                'is_positive' => 'required_without_all:title,image_path|integer|min:0|max:1',
                'rating' => 'required_without_all:title,caption|integer|min:1|max:5',
            ];
            $validator = Validator::make($request, $rules);
            if($validator->fails()){
                return response()->json([
                    "message" => "Update review failed.",
                    "error" => $validator->errors()
            ], 400);
            }else{
                $review->update($request);
                return response()->json([
                    "message" => "Update review success.",
                    "review" => $review,
                ], 200);
            }
        }else{
            return response()->json([
                "message" => "Review record not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if($review) {
            $review->delete();
            return response()->json([
                    "message" => "Delete review success.",
                    "deleted_data" => $review
                ]
                , 200);
        } else {
            return response()->json([
                "message" => "Review record not found."
            ], 404);
        }
    }
}
