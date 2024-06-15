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
        log::debug('게시글 정보', $boardList);
        
        $responseData= [
            'code' => '0'
            ,'msg' => ''
            // ,'data' => $boardList->toArray()
            ,'data' => $boardList
        ];

        log::debug('responseData1', $responseData);

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
        Log::debug('responseData2', $responseData);
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
                // 'type' => ['required']
                'title' => ['required', 'min:1', 'max:50']
                ,'content' => ['required', 'min:1', 'max:500']
                ,'main_img' => ['image']
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

        // insert 데이터 생성
        $communityModel = Community::select('communities.*', 'users.id')
                                    ->join('users', 'users.id', '=', 'communities.id')
                                    ->where('users.id', Auth::id())
                                    ->first();

        $communityModel->title = $request->title;
        Log::debug('타이틀', $communityModel->title);
        $communityModel->content = $request->content;
        $communityModel->main_img = $mainImgPath;
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











    // 상세페이지 리뷰 목록 가져오기
    // public function detailReviewGet() {
    //     $data = Community::select('communities.*', 'users.nick_name')
    //                         ->join('users', 'users.id', '=', 'communities.user_id')
    //                         ->orderBy('communities.id', 'DESC')
    //                         ->get();
    //     $responseData = [
    //         'code' => '0',
    //         'msg' => '게시글 획득 완료',
    //         'data' => $communityData->toArray()
    //     ];
    //     Log::debug('쿼리', $communityData->toArray());
    //     Log::debug('responseData', $responseData);
    //     Log::debug('리턴');
        
    //     return response()->json($responseData, 200);
    // }




    // 서린 메인 커뮤글
    public function mainCommunity(Request $request) {
        $RankData = Community::select('communities.title', 'users.name')
                        ->join('users', 'users.id', '=', 'communities.user_id')
                        ->where('communities.type', '<>', 2) // type이 2인 것 제외
                        ->orderBy('communities.views', 'DESC') // views 기준 내림차순 정렬
                        ->take(5) // 최대 5개의 결과만 가져옴
                        ->get();
    
        Log::debug($RankData);
    
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $RankData->toArray()
        ];
    
        return response()->json($responseData, 200);
    }
    
    
}
    

