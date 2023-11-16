<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\BallController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Create a new bucket
Route::post('/buckets', [BucketController::class, 'create']);

// Get all buckets
Route::get('/buckets', [BucketController::class, 'getBuckets']);

// Create a new ball
Route::post('/balls', [BallController::class, 'store']);

//Suggest Buckets
Route::post('/suggest-buckets', [BucketController::class, 'suggestBuckets']);

