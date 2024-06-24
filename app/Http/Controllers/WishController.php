<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    // public function wishBtnAdd($id){
    //     $insertData['user_id'] = Auth::id();

    //     $campId = Camp::find($id);
    //     $insertData['camp_id'] = $campId->id;

    //     $wishInsert = Wish::create($insertData);

    //     $responseData = [
    //         'code' => '0',
    //         'msg' => '',
    //         'data' => $wishInsert
    //     ];

    //     return response()->json($responseData, 200);   
    // }

    public function wishBtnUpsert($id){
        $camp_id = Camp::find($id)->id;
        $wishInsert = Wish::upsert(
                        ['user_id' => Auth::id(), 'camp_id'=> $camp_id, 'updated_at'=> now(), 'deleted_at'=>null],
                        ['user_id', 'camp_id'],
                        ['updated_at', 'deleted_at']
                    );
        $responseData = [
       'code' => '0',
        'msg' => '',
        'data' => $wishInsert
        ];
        Log::debug('업설트', $responseData);
       return response()->json($responseData, 200);   

    }

    public function wishBtnRemove($id){
        $camp_id = Camp::find($id)->id;
        $wishDelete = Wish::where('user_id', '=', Auth::id())
                            ->where('camp_id', '=', $camp_id)
                            ->delete();
        
        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $wishDelete
        ];
                
        return response()->json($responseData, 200);   
    }

}
