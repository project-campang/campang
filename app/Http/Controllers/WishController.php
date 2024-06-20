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
}
