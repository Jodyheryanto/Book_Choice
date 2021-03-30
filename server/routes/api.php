<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/book/search/{keyword}', 'BookController@searchBook');
Route::get('/book/category/{category}', 'BookController@showBookByCategory');
Route::resource('/book', 'BookController')->except(['create', 'edit']);
Route::resource('/review', 'ReviewController')->except(['create', 'edit']);
Route::resource('/user', 'UserController')->except(['create', 'edit']);
Route::resource('/carousel', 'CarouselController')->only(['index', 'show']);
Route::resource('/guestbook', 'GuestBookController')->except(['create', 'edit']);