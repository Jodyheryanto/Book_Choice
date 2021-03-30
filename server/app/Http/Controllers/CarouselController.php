<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;

use Validator;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::get();
        if(sizeof($carousels) == 0){
            return response()->json([
                "message" => "No carousel records here."
            ], 404);
        }else{
            return response()->json([
                "message" => "Get carousel record success",
                "carousel" => $carousels
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request = $request->only(['title','caption','image_path']);
        $rules = [
            'title' => 'required',
            'caption' => 'required',
            'image_path' => 'required',
        ];

        $validator = Validator::make($request, $rules);
        if($validator->fails()){
            return response()->json([
                "message" => "Insert carousel failed.",
                "error" => $validator->errors()
            ], 400);
        } else {
            $carousel = Carousel::create($request);
            return response()->json([
                "message" => "Insert carousel success.",
                "carousel" => $carousel
            ], 201);
        }
    }

    public function show($id)
    {
        $carousel = Carousel::where('id', $id)->get();
        if (sizeof($carousel) == 0) {
            return response()->json([
                "message" => "Carousel record not found."
            ], 404);
        } else {
            return response()->json([
                "message" => "Get carousel record success.",
                "carousel" => $carousel
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['title','caption','image_path']);
        $carousel = carousel::find($id);
        if($carousel){
            $rules = [
                'title' => 'required_without_all:caption,image_path',
                'caption' => 'required_without_all:title,image_path',
                'image_path' => 'required_without_all:title,caption',
            ];
            $validator = Validator::make($request, $rules);
            if($validator->fails()){
                return response()->json([
                    "message" => "Update carousel failed.",
                    "error" => $validator->errors()
                ], 400);
            }else{
                $carousel->update($request);
                return response()->json([
                    "message" => "Update carousel success.",
                    "carousel" => $carousel,
                ], 200);
            }
        }else{
            return response()->json([
                "message" => "Carousel record not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $carousel = Carousel::find($id);
        if($carousel) {
            $carousel->delete();
            return response()->json([
                    "message" => "Delete carousel success.",
                    "deleted_data" => $carousel
                ]
                , 200);
        } else {
            return response()->json([
                "message" => "Carousel record not found."
            ], 404);
        }
    }
}
