<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CampController;
use Illuminate\Support\Facades\Route;

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

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');

// 유저컨트롤러
Route::post('/api/login', [UserController::class, 'login']);
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/logout', [UserController::class, 'logout']);

// 캠핑장 컨트롤러
Route::get('/search', [CampController::class, 'search']);

// 댓글 컨트롤러
Route::post('/api/comment', [CommentController::class, 'comment']);
Route::get('/api/comment', [CommentController::class, 'comment_get']);

// 커뮤니티컨트롤러
Route::get('/community', [CommunityController::class, 'community']);