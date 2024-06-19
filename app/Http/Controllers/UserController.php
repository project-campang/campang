<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Exceptions\MyValidateException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 로그인 처리
    public function login(Request $request)
    {   
         // 유효성 검사
         $validator = Validator::make(
            $request->only('email', 'password')
            ,[
                'email' => ['required', 'regex:/^[-A-Za-z0-9_]+[-A-Za-z0-9_.][@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.][.]{1}[A-Za-z]{1,5}$/']
                ,'password' => ['required', 'min:4', 'max:20', 'regex:/^[a-zA-Z0-9]+$/']
            ]
            );

        // 유효성 검사 실패시 처리
        if($validator->fails()) {
            Log::debug('유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01');
        }

        // 유저 정보 획득
        $userInfo = User::select('users.*')
                            ->where('email', $request->email)
                            ->first();

        // 유저 정보 없음
        if(!isset($userInfo)) {
            // 유저 없음
            throw new MyAuthException('E20');
        }
        else if(!(Hash::check($request->password, $userInfo->password))) {
            // 비밀번호 오류
            throw new MyAuthException('E21');
            return response()->json([
                'status' => 'error',
                'errors' => ['email' => ['이메일 또는 비밀번호가 잘못되었습니다.']]
            ], 422);
        }

        // 로그인 처리
        Auth::login($userInfo);
        
        // 레스폰스 데이터 생성
        $responseData = [
            'code' => '0'
            ,'msg' => '로그인 성공'
            ,'data' => $userInfo
        ];

        return response()->json($responseData, 200)->cookie('auth', '1', 120, null, null, false, false);
    }

    // 회원가입 처리
    public function register(Request $request)
    {
        $requestData = $request->all();
        // LOG::debug($requestData);
        $validator = validator::make(
            $requestData,
            [
                'password' => ['required', 'min:2', 'max:20', 'regex:/^[a-zA-Z0-9!@*]+$/'],
                'ps_chk' => ['same:password'],
                'nick_name' => ['required', 'min:2', 'max:10', 'regex:/^[가-힣]+$/u'],
                'name' => ['required', 'min:2', 'max:20', 'regex:/^[가-힣]+$/u'],
                'email' => ['required', 'regex:/^[-A-Za-z0-9_]+[-A-Za-z0-9_.][@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.][.]{1}[A-Za-z]{1,5}$/'],
                'tel' => ['required', 'regex:/^(\d{2,3}-\d{3,4}-\d{4})|(\d{10,11})$/']
            ]
        );

        if ($validator->fails()) {
            Log::debug('유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01');
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // 작성 데이터 생성
        $insertData = $request->all();

        // 데이터 로그 출력
        Log::debug('Insert data: ', $insertData);

        // 비밀번호 설정
        $insertData['password'] = Hash::make($request->password);

        // 인서트 처리
        $userInfo = User::create($insertData);

        $responseData = [
            'code' => '0',
            'msg' => '회원가입 성공',
            'data' => $userInfo
        ];

        return response()->json($responseData, 200);
    }

      // 로그아웃 처리
      public function logout()
      {
        Auth::logout(Auth::user());
        Session::invalidate(); // 기존 세션 파기하고 새로운 세션 생성
        Session::regenerateToken(); // csrf 토큰 재발급

        $responseData = [
            'code' => '0'
            ,'msg' => '로그아웃 완료'
        ];

        return response()
                ->json($responseData, 200)
                ->cookie('auth', '1', -1, null, null, false, false);
      }
      
    // 이메일 중복체크
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        return response()->json([
            'duplicate' => !!$user // 중복된 이메일이 있으면 true, 없으면 false 반환
        ]);
    }


    
    // public function getKakaoLoginUrl() {
    //     $clientId = config('services.kakao.client_id');
    //     $redirectUri = config('services.kakao.redirect_uri');

    //     $loginUrl = "https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}";

    //     return response()->json($loginUrl);
    // }

    // 카카오 콜백
    public function kakaoCallback(Request $request) {
        $code = $request->query('code');

        $client = new Client();
        $response = $client->post('https://kauth.kakao.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'd7c42425629cbc0e91436aca75ca6fcc',  
                'redirect_uri' => 'http://127.0.0.1:8000/oauth/kakao', 
                'code' => $code,
            ],
        ]);

        $accessTokenData = json_decode($response->getBody(), true);

        $accessToken = $accessTokenData['access_token'];

        // Access token을 사용하여 사용자 정보를 요청하는 예제
        $userResponse = $client->get('https://kapi.kakao.com/v2/user/me', [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
            ],
        ]);

        $userData = json_decode($userResponse->getBody(), true);


        return response()->json([
            'profile_image' => $userData['profile'],
            'profile_nickname' => $userData['properties']['nickname'],
        ]);

        
    }
}

      

