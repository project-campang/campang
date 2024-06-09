<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 로그인 처리
    public function login(Request $request)
    {   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => '로그인 성공',
                'user' => $user
            ]);
        } else {
            return response()->json(['message' => '로그인 실패'], 401);
        }
    }

    // 회원가입 처리
    public function register(Request $request)
    {
        $requestData = $request->all();

        $validator = validator::make(
            $requestData
            ,[
                'id' => ['required','min:4','max:20','unique:users', 'regex:/^[a-zA-Z0-9]+$/']
                ,'password' => ['required', 'min:2', 'max:20', 'regex:/^[a-zA-Z0-9!@*]+$/']
                ,'ps_chk' => ['same:password']
                ,'nickname' => ['required', 'min:2', 'max:20', 'regex:/^[가-힣]+$/u']
                ,'name' => ['required', 'min:2', 'max:20', 'regex:/^[가-힣]+$/u']
                ,'email' => ['required', 'regex:/^[-A-Za-z0-9_]+[-A-Za-z0-9_.][@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.][.]{1}[A-Za-z]{1,5}$/']
                ,'phone_number' => ['required', 'regex:/^\d{2,3}-\d{3,4}-\d{4}$/']
            ]
        );

        // 유효성 검사 실패 체크
        if($validator->fails()) {
            Log::debug('유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 작성 데이터 생성
    $insertData = $request->all();

    // 비밀번호 설정
    $insertData['password'] = Hash::make($request->password);

    // 인서트 처리
    $userInfo = User::create($insertData);

    $responseData = [
        'code' => '0'
        ,'msg' => '회원가입 성공'
        ,'data' => $userInfo
    ];

    return response()->json($responseData, 200);

    }

    // 로그아웃 처리
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => '로그아웃 성공']);
    }
}
