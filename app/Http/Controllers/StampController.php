<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StampController extends Controller
{

public function stampGet(Request $request) {
    // 현재 로그인한 사용자의 ID를 가져옴
    $userId = Auth::id();

    // 사용자의 스탬프 정보를 가져옴
    $StampData = Stamp::select('stamps.updated_at', 'camps.name as camp_name', 'camps.main_img', 'stamps.camp_id')
                    ->join('users', 'users.id', '=', 'stamps.user_id')
                    ->leftJoin('camps', 'camps.id', '=', 'stamps.camp_id')
                    ->where('stamps.user_id', $userId) // 현재 사용자의 스탬프만 필터링
                    ->orderBy('stamps.updated_at', 'DESC') // updated_at 기준 내림차순 정렬
                    ->get();

    $responseData = [
        'code' => '0',
        'msg' => '사용자의 스탬프 데이터 획득 완료',
        'data' => $StampData->toArray()
    ];

    return response()->json($responseData, 200);
}

    
}
