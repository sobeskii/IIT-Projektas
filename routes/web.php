<?php

use App\Http\Controllers\ArtistController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikedRatingsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

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
Route::get('/releases/chart',[ReleaseController::class,'show_chart'])->name('release.chart');


Route::put('release/rating/put',[RatingController::class, 'put'])->name('rating.put');
Route::post('release/rating/{rating}/delete',[RatingController::class,'delete'])->name('rating.delete');

Route::post('release/rating/{rating}/toggle/' ,[LikedRatingsController::class,'toggle'])->name('like');

Route::get('/artist/{spotifyId}',[ArtistController::class,'index'])->name('artist.index');

Route::get('/user/reactions',[UserController::class,'show_reactions'])->name('user.reactions');
Route::get('/user/ratings',[UserController::class,'show_ratings'])->name('user.ratings');

