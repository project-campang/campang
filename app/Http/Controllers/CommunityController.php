<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use Exception;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{

    //  게시글 획득
    public function communityGet() {

        // 유효성 체크용 데이터 초기화
        // $request = [
        //     'id' => $id
        // ];

        // 유효성 체크
        // $validator = Validator::make(
        //     $request->only('id'),
        //     [
        //         'id' => ['regex:/^[0-9]+$/'],
        //     ]
        // );

        // 유효성 체크 실패 시 처리
        // if($validator->fails()) { // 실패하면 true 반환
        //     throw new Exception('유효성 검사 실패');
        //     Log::debug('획득 시 유효성 검사 실패', $validator->errors()->toArray());
        //     // throw new MyValidateException('E01');
        // }

        // 게시글 정보 획득
        $boardList = Community::join('users', 'communities.user_id', '=', 'users.id')
                                ->select('communities.*', 'users.name')
                                ->orderBy('communities.id', 'DESC')
                                ->get();
        
        $responseData= [
            'code' => '0'
            ,'msg' => ''
            // ,'data' => $boardList->toArray()
            ,'data' => $boardList
        ];

        return response()->json($responseData, 200);

        $communityData = Community::select('communities.*', 'users.nick_name')
                                    ->join('users', 'users.id', '=', 'communities.user_id')
                                    ->orderBy('communities.id', 'DESC')
                                    ->get();
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $communityData->toArray()
        ];
        Log::debug('쿼리', $communityData->toArray());
        Log::debug('responseData', $responseData);
        Log::debug('리턴');
        
        return response()->json($responseData, 200);
    }





    // 게시글 작성
    public function communityStore(Request $request) {

        // 유효성 체크용 데이터 초기화
        // $requestData = [
        //     'title' => $request->title
        //     ,'content' => $request->content
        //     ,'main_img' => $request->mainImg
        //     ,'other_img2' => $request->otherImg2
        //     ,'other_img3' => $request->otherImg3
        //     ,'other_img4' => $request->otherImg4
        //     ,'other_img5' => $request->otherImg5
        // ];

        // 유효성 체크
        $validator = Validator::make(
            // $request->only('title', 'content', 'main_img','other_img2','other_img3','other_img4','other_img5')
            $request->all()
            ,[
                'title' => ['required', 'min:1', 'max:50']
                ,'content' => ['required', 'min:1', 'max:500']
                ,'main_img' => ['required', 'image']
                ,'other_img2' => ['image']
                ,'other_img3' => ['image']
                ,'other_img4' => ['image']
                ,'other_img5' => ['image']
            ]
        );

        // 유효성 검사 실패 시 처리
        if($validator->fails()) {
            Log::debug('---', $validator->errors()->toArray());
            Log::debug('작성 시 유효성 검사 실패', $validator->errors()->toArray());
            throw new Exception('유효성 검사 실패');
        }

        // 파일 저장
        // if($request->hasFile('main_img')) {
        //     $mainImgPath = $request->file('main_img')->store('main_img');
        // }
        $mainImgPath = $request->file('main_img')->store('main_img');
        $otherImg2Path = $request->file('other_img2')->store('other_img2');
        $otherImg3Path = $request->file('other_img3')->store('other_img3');
        $otherImg4Path = $request->file('other_img4')->store('other_img4');
        $otherImg5Path = $request->file('other_img5')->store('other_img5');

        // insert 데이터 생성
        $communityModel = Community::select('communities.*', 'users.id')
                                    ->join('users', 'users.id', '=', 'communities.id')
                                    ->where('users.id', Auth::id())
                                    ->first();

        $communityModel->title = $request->title;
        $communityModel->content = $request->content;
        $communityModel->main_img = $mainImgPath;
        $communityModel->otherImg2 = $otherImg2Path;
        $communityModel->otherImg3 = $otherImg3Path;
        $communityModel->otherImg4 = $otherImg4Path;
        $communityModel->otherImg5 = $otherImg5Path;
        $communityModel->user_id = Auth::id();
        $communityModel->save();

        // response 처리
        $responseData = [
            'code' => '0'
            ,'msg' => '게시글 작성 완료'
            ,'data' => $communityModel->toArray()
        ];

        // 리턴
        return response()->json($responseData, 200);
    }

    // 게시글 수정



    // 게시글 삭제



    // 게시글 획득


}
