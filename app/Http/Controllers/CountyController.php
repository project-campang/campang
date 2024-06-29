<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountyController extends Controller
{
        // 군/구 데이터 획득
        public function countyGet($id) {
        
            $countyList = County::select('counties.*')
                            ->orderBy('counties.id')
                            ->where('state_id', $id)
                            ->get();

            // log::debug('군/구', $countyList->toArray());
    
            $responseData = [
                'code' => '0'
                ,'msg' => '군/구 획득'
                ,'data' => $countyList->toArray()
            ];
    
            // log::debug('responseData', $responseData);
    
            return response()->json($responseData, 200);
        }
}
