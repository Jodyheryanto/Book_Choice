<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use Validator;

class BookController extends Controller
{
   
    public function index()
    {
        $book = Book::get();
        if(sizeof($book) == 0){
            return response()->json(["message" => "No records here"], 404);
        }else{
            return response()->json([
                "book" => $book
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'cover' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publish_date' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        } else {
            $book = Book::create($request->all());
            return response()->json([
                "message" => "Insert book success.",
                "book" => $book
            ], 201);
        }
    }

    public function show($id)
    {
        $book = Book::where('id', $id)->get();
        if (sizeof($book) == 0) {
            return response()->json(["message" => "Record not found."], 404);
        } else {
            return response()->json([
                "book" => $book
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if($book){
            $rules = [
                'title' => 'required_without_all:cover,category,author,publish_date,description',
                'cover' => 'required_without_all:title,category,author,publish_date,description',
                'category' => 'required_without_all:title,cover,author,publish_date,description',
                'author' => 'required_without_all:title,cover,category,publish_date,description',
                'publish_date' => 'required_without_all:title,cover,category,author,description|date_format:Y-m-d',
                'description' => 'required_without_all:title,cover,category,author,publish_date',
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }else{
                $book->update($request->all());
                return response()->json([
                    "message" => "Update book success.",
                    "book" => $book,
                ], 200);
            }
        }else{
            return response()->json([
                "message" => "Record not found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if($book) {
            $book->delete();
            return response()->json([
                    "message" => "Delete book success.",
                    "deleted_data" => $book
                ]
                , 200);
        } else {
            return response()->json(["message" => "Record not found."], 404);
        }
    }

    public function searchBook($keyword){
        $books = Book::where('title', 'ilike', '%'.$keyword.'%')->orderBy('id','desc')->get();
        if (sizeof($books) == 0) {
            return response()->json([
                "message" => "Record not found"
            ], 404);
        } else {
            return response()->json([
                'books' => $books
            ], 200);
        }
    }

    public function showBookByCategory($category){
        $books = Book::where('category', 'ilike', '%'.$category.'%')->get();
        if (sizeof($books) == 0) {
            return response()->json([
                "message" => "Record not found"
            ], 404);
        } else {
            return response()->json([
                'books' => $books
            ], 200);
        }
    }
}
