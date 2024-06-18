<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function suggestBrand(Request $request)
{
    $recentbrand = Brand::select('name', 'img')
                      ->orderBy('name', 'DESC') // name 필드를 기준으로 정렬
                      ->take(4) // 최대 4개의 결과만 가져옴
                      ->get();

    Log::debug('recentbrand', $recentbrand->toArray());

    $responseData = [
        'code' => '0',
        'msg' => '게시글 획득 완료',
        'data' => $recentbrand->toArray()
    ];

    return response()->json($responseData, 200);
}

    
}
