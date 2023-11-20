<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\BallController;
use App\Models\Ball;
use App\Models\Bucket;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $balls = Ball::all();
    $buckets = Bucket::all(); // Fetch all buckets
    return view('welcome', ['balls' => $balls, 'buckets' => $buckets]);
})->name('welcome');


// Ball routes
Route::post('/balls/create', [BallController::class, 'create'])->name('balls.create');
Route::post('/balls/store', [BallController::class, 'store'])->name('balls.store');

// Bucket routes
Route::post('/buckets/create', [BucketController::class, 'create'])->name('buckets.create');
Route::get('/buckets', [BucketController::class, 'getBuckets'])->name('buckets.get');
Route::post('/buckets/suggest', [BucketController::class, 'suggestBuckets'])->name('buckets.suggest');

