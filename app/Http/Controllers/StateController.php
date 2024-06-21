<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
        // 시/도 데이터 획득
        public function stateGet() {

            $stateList = State::select('states.*')
                            ->orderBy('states.id')
                            ->get();
    
            // log::debug('시/도', $stateList->toArray());
    
            $responseData = [
                'code' => '0'
                ,'msg' => '시/도 획득'
                ,'data' => $stateList->toArray()
            ];
    
            // log::debug('responseData', $responseData);
    
            return response()->json($responseData, 200);
        }
}
