<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;

class CampTopoController extends Controller
{
    public function campingzang() {
        $RankData = Camp::select('camps.id', 'camps.name', 'camps.main_img')
                    ->join('reviews', 'camps.id', '=', 'reviews.camp_id')
                    ->where('reviews.rating', 5)  // rating이 5인 것만 필터링
                    ->orderBy('camps.id', 'DESC')
                    ->take(3)  // 최대 3개의 결과만 가져옴
                    ->get();
        $responseData = [
            'code' => '0'
            ,'msg' => '게시글 획득 완료'
            ,'data' => $RankData->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function campingler() {
        $topReviewers = User::select('users.id', 'users.name', 'users.profile')
        ->join('communities', 'users.id', '=', 'communities.user_id')
        ->join('reviews', 'communities.id', '=', 'reviews.community_id')
        ->selectRaw('users.id, users.name, users.profile, COUNT(reviews.id) as review_count')
        ->groupBy('users.id', 'users.name', 'users.profile')
        ->orderByDesc('review_count')
        ->take(3)
        ->get();

        // 상위 리뷰어들의 데이터를 반환
        return response()->json([
        'code' => '0',
        'msg' => '상위 리뷰어 목록 획득 완료',
        'data' => $topReviewers->toArray()
        ], 200);
    }
}
