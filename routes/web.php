<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikedRatingsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search',[SearchController::class,'index'])->name('search.index');

Route::get('/release/{spotifyId}',[ReleaseController::class,'index'])->name('release.index');

Route::put('release/rating/put',[RatingController::class, 'put'])->name('rating.put');
Route::post('release/rating/{rating}/delete',[RatingController::class,'delete'])->name('rating.delete');

Route::post('release/rating/{rating}/toggle/' ,[LikedRatingsController::class,'toggle'])->name('like');
