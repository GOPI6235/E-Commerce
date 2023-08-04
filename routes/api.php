<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('/register',[App\Http\Controllers\Api\loginController::class,'register']);
// Route::post('/login',[App\Http\Controllers\Api\loginController::class,'login']);




Route::post('newcategory',[App\Http\Controllers\Admin\CatogoryController::class,'insert']);
Route::get('/categories', [App\Http\Controllers\Admin\CatogoryController::class, 'getCategoryData']);
