<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function getBizInfo($id){
        $biz = Business::where('user_id',$id)->get();

        $responseData = [
            'code'=>'0',
            'msg'=>'',
            'data'=>$biz->toArray(),
        ];
        return response()->json($responseData, 200);
    }
}
