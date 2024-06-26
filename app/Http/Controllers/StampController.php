<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StampController extends Controller
{

    
    public function stampGet(Request $request) {
        $userId = Auth::id();
        

        $stampData = Stamp::select('stamps.updated_at', 'camps.name as camp_name', 'camps.main_img', 'stamps.camp_id')
            ->join('users', 'users.id', '=', 'stamps.user_id')
            ->join('camps', 'camps.id', '=', 'stamps.camp_id')
            ->where('stamps.user_id', $userId)
            ->orderBy('stamps.updated_at', 'DESC')
            ->get();
        

        $responseData = [
            'code' => '0',
            'msg' => '사용자의 스탬프 데이터 획득 완료',
            'data' => $stampData->toArray()
        ];
        
        return response()->json($responseData, 200);
    }
    
    
    public function stampStore($id) {
        $userId = Auth::id();
        $campId = Camp::find($id);
        
        $existingStamp = Stamp::where('user_id', $userId)
                              ->where('camp_id', $campId->id)
                              ->exists();

        if ($existingStamp) {
            return response()->json(['message' => 'Duplicate stamp.'], 409); // Conflict 상태 코드 반환
        }



        $insertData['user_id'] = $userId;
        $insertData['camp_id'] = $campId->id;
        // Log::debug('캠프아이디', Camp::find($id)->toArray() );

        $stampInsert = Stamp::create($insertData);
        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $stampInsert
        ];
        Log::debug('스탬프갱신성공', $stampInsert->toArray());

        return response()->json($responseData, 200);   


    }
    
}
