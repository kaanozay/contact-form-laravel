<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactFormController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('list/{search?}', 'App\Http\Controllers\ContactFormController@showAll');
    Route::get('message/{id}', 'App\Http\Controllers\ContactFormController@showMessage');
    Route::get('delete/{id}', 'App\Http\Controllers\ContactFormController@deleteMessage');
});

Route::post('contact', 'App\Http\Controllers\ContactFormController@store');

//Route::post("login",[UserController::class,'index']);


