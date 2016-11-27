<?php

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/book','BookController@get');
Route::get('/author','AuthorController@get');

Route::post('/book','BookController@create');
Route::post('/author','AuthorController@create');

Route::put('/book/{bookId}','BookController@update');
Route::put('/author/{authorId}','AuthorController@delete');

Route::delete('/book/{bookId}','BookController@delete');
Route::delete('/author/{authorId}','AuthorController@delete');


Route::get('/book/{id}','BookController@getById');
Route::get('/author/{id}','AuthorController@getById');

