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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('book', 'BookController@book');

Auth::routes(['verify' => true]);

Route::get('email/verify/{id}', 'VerificationController@verify')->middleware('signed')->name('verification.verify');
Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');

//Route::middleware('verified')->group(function () {
    Route::get('company', 'CompanyController@index')->middleware(['jwt.verify']);//->middleware('verified');
    Route::post('company', 'CompanyController@store')->middleware('jwt.verify');
    Route::put('company/{id}', 'CompanyController@update')->middleware('jwt.verify');
    Route::delete('company/{id}', 'CompanyController@destroy')->middleware('jwt.verify');
//});