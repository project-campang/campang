<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    // public function clickWishBtn(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $camp_id = $request->input('camp_id');

    //     // 이미 찜한 상태인지 확인
    //     $existingWish = Wish::where('user_id', $user_id)
    //                         ->where('camp_id', $camp_id)
    //                         ->first();

    //     if ($existingWish) {
    //         // 이미 찜한 경우 삭제 (논리적 삭제)
    //         $existingWish->delete();

    //         $responseData = [
    //             'code' => '0',
    //             'msg' => 'Wish removed successfully',
    //             'data' => $existingWish
    //         ];
    //     } else {
    //         // 찜하지 않은 경우 추가
    //         $insertData = [
    //             'user_id' => $user_id,
    //             'camp_id' => $camp_id
    //         ];

    //         $wishInsert = Wish::create($insertData);

    //         $responseData = [
    //             'code' => '0',
    //             'msg' => 'Wish added successfully',
    //             'data' => $wishInsert
    //         ];
    //     }

    //     return response()->json($responseData, 200);
    // }

    public function wishGet(Request $request) {
        // 현재 로그인한 사용자의 ID를 가져옴
        $userId = Auth::id();
    
        // 사용자의 위시리스트 정보를 가져옴
        $WishData = Wish::select('wishes.created_at', 'camps.name as camp_name', 'camps.main_img', 'wishes.camp_id')
                        ->join('users', 'users.id', '=', 'wishes.user_id')
                        ->leftJoin('camps', 'camps.id', '=', 'wishes.camp_id')
                        ->where('wishes.user_id', $userId) // 현재 사용자의 위시리스트만 필터링
                        ->orderBy('wishes.updated_at', 'DESC') // updated_at 기준 내림차순 정렬
                        ->get();
    
        $responseData = [
            'code' => '0',
            'msg' => '사용자의 위시리스트 데이터 획득 완료',
            'data' => $WishData->toArray()
        ];
    
        return response()->json($responseData, 200);
    }
}
