<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampTopoController extends Controller
{
    public function campingzang() {
        $RankData = Camp::select('camps.id', 'camps.name', 'camps.main_img')
                        ->join('communities', 'camps.id', '=', 'communities.camp_id')
                        ->where('communities.rating', 5)  // rating이 5인 것만 필터링
                        ->orderBy('camps.id', 'DESC')
                        ->take(3)  // 최대 3개의 결과만 가져옴
                        ->get();
    Log::debug($RankData);
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $RankData->toArray()
        ];
    
        return response()->json($responseData, 200);
    }
    

    public function campingler() {
        $topReviewers = User::select('users.id', 'users.nick_name', 'users.profile')
            ->join('stamps', 'users.id', '=', 'stamps.user_id')
            ->selectRaw('users.id, users.nick_name, users.profile, COUNT(stamps.id) as stamp_count')
            ->groupBy('users.id', 'users.nick_name', 'users.profile')
            ->orderByDesc('stamp_count')  // stamps.user_id가 가장 많은 순서대로 정렬
            ->take(3)  // 최대 3명의 유저만 가져옴
            ->get();
    
        Log::debug($topReviewers);
        return response()->json([
            'code' => '0',
            'msg' => '상위 스탬프 유저 목록 획득 완료',
            'data' => $topReviewers->toArray()
        ], 200);
    }
    
}
