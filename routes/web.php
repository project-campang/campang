<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\CampTopoController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CommunityTypeController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Log;
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
//앱
// 유저 컨트롤러
Route::post('/api/login', [UserController::class, 'login']);
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/logout', [UserController::class, 'logout']);
Route::post('/api/check-email', [UserController::class, 'checkEmail']);
Route::post('/mypage/update', [UserController::class, 'update']);
Route::get('/api/mypage/stamp', [StampController::class, 'stampGet']);
Route::get('/api/mypage/wishes', [WishController::class, 'wishGet']);
Route::get('/api/mypage/content', [CommunityController::class, 'contentGet']);
Route::get('/api/mypage/review', [CommunityController::class, 'reviewGet']);
Route::get('/api/mypage/comment', [CommentController::class, 'CommentGet']);
Route::post('/api/content/update', [CommunityController::class, 'updateContent']);
Route::post('/api/review/update', [CommunityController::class, 'updateReview']);
Route::post('/api/comment/update', [CommentController::class, 'updateWish']);
Route::delete('/api/posts/delete/{id}', [CommunityController::class, 'deletePost']);
Route::delete('/api/reviews/delete/{id}', [CommunityController::class, 'deleteReview']);
Route::delete('/api/comments/delete/{id}', [CommentController::class, 'deleteComment']);
// 카카오로그인
// Route::get('/api/kakao-login', [UserController::class, 'getKakaoLoginUrl']);
Route::get('/oauth/kakao', [UserController::class, 'kakaoCallback']);

// main
Route::get('/api/main',[CampTopoController::class, 'campingler']);
Route::get('/api/rank',[CampTopoController::class, 'campingzang']);
Route::get('/api/main/community',[CommunityController::class, 'mainCommunity']);
Route::get('/api/main/tip',[CommunityController::class, 'mainTip']);
Route::get('/api/main/suggest/campingzang',[CampController::class, 'suggestCampingzang']);
Route::get('/api/main/suggest/brand',[BrandController::class, 'suggestBrand']);
Route::get('/api/main/stampTarget', [CampController::class, 'gpsTargetStamp']);
Route::get('/api/stampCnt', [CampController::class, 'stampCnt']);
Route::post('/api/stampStore/{id}', [StampController::class, 'stampStore']);

// 캠프 컨트롤러
Route::get('/api/search/searchPage', [CampController::class, 'campListGet']);
// Route::post('/api/search/searchPage', [CampController::class, 'searchResult']); // 같은 처리이므로 불필요
Route::get('/api/searchCount', [CampController::class, 'searchResultCount']);
// Route::get('/api/camp/commentPage', [CommentController::class, 'commentPaginate']);
Route::get('/api/camp/{id}', [CampController::class, 'campDetailGet']);
Route::get('/api/state', [StateController::class, 'stateGet']); // state
Route::get('/api/county/{id}', [CountyController::class, 'countyGet']); // county
// Route::get('/api/camp/{id}/imgs', [CampController::class, 'allImgGet']);

// 댓글 컨트롤러
Route::post('/api/comment/{id}', [CommentController::class, 'comment']);
Route::get('/api/camp/{id}/commentPage', [CommentController::class, 'commentPaginate']);
Route::get('/api/camp/{id}/reviewTap', [CommunityController::class, 'detailReviewGet']);
Route::post('/api/comment/{id}/update', [CommentController::class, 'commentUpdate']);
Route::delete('/api/comment/{id}/delete', [CommentController::class, 'commentDelete']);

// 커뮤니티 컨트롤러
// Route::get('/api/community/{id}/communityPage', [CommunityController::class, 'communityGet']);
Route::get('/api/community/{id}/communityPage', [CommunityController::class, 'communityGet']);
Route::post('/api/community/{id}', [CommunityController::class, 'communityStore']);
Route::get('/api/communityTypes/{id}', [CommunityTypeController::class, 'index']);
// Route::get('/api/community/communityTypes', [CommunityTypeController::class, 'index']);


// 위시 컨트롤러
    //위시 추가
Route::post('/api/camp/{id}/wishBtnUpsert', [WishController::class, 'wishBtnUpsert']);