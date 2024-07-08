<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        // 유효성 검사
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4', 'max:20'],
        ]);

        // 유효성 검사 실패시 처리
        if ($validator->fails()) {
            Log::debug('유효성 검사 실패', $validator->errors()->toArray());
            return response()->json(['message' => '유효성 검사 실패 유저', 'errors' => $validator->errors()], 422);
        }

        // 유저 정보 획득
        $userInfo = Admin::where('email', $request->email)->first();

        // 유저 정보 없음
        if (!$userInfo) {
            Log::debug('로그인 실패: 해당 유저 정보가 없습니다.');
            return response()->json(['message' => '아이디 혹은 비밀번호가 틀렸습니다.'], 401);
        }

        // 비밀번호 확인
        if (!Hash::check($request->password, $userInfo->password)) {
            Log::debug('로그인 실패: 비밀번호가 일치하지 않습니다.');
            return response()->json(['message' => '아이디 혹은 비밀번호가 틀렸습니다.'], 401);
        }

        // 로그인 처리
        Auth::login($userInfo);

        // 레스폰스 데이터 생성
        $responseData = [
            'code' => '0',
            'msg' => '로그인 성공',
            'data' => $userInfo
        ];

        return response()->json($responseData, 200)->cookie('auth', '1', 120, null, null, false, false);
    }
}
