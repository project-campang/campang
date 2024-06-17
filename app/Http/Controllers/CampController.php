<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CampController extends Controller
{
    // 검색
    public function search(Request $request) {

    }

    public function suggestCampingzang(Request $request)
    {
        try {
            // 가장 최근의 캠핑장 데이터를 가져옵니다.
            $recentCamp = Camp::select('name', 'main_img')
                              ->orderBy('created_at', 'DESC')
                              ->first();

            if (!$recentCamp) {
                return response()->json([
                    'code' => '1',
                    'msg' => '캠핑 정보가 없습니다.',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'code' => '0',
                'msg' => '최근 캠핑 정보 획득 완료',
                'data' => $recentCamp->toArray()
            ], 200);
        } catch (\Exception $e) {
            // 로그에 에러를 기록합니다.
            Log::error('Error in suggestCampingzang: ' . $e->getMessage());
            return response()->json([
                'code' => '2',
                'msg' => '서버 오류가 발생했습니다.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
