<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    // 게시글 작성
    public function communityInsert(Request $request) {

        // 유효성 체크
        $validator = Validator::make(
            $request->only('title', 'content', 'img')
            ,[
                'title' => ['required', 'min:1', 'max:50']
                ,'content' => ['required', 'min:1', 'max:500']
                ,'img' => ['required', 'image']
            ]
        );
            // 유효성 검사 실패 시 처리
            if($validator->fails()) {
                throw new Exception('유효성 검사 실패');
            }
    
            // 파일 저장
            $filepath = $request->file('img')->store('img');
            
            // insert 데이터 생성
            // 모델 인스턴스하는 방법
            $communityModel = Community::select('communities.*', 'users.id')
                                        ->join('users', 'users.id', '=', 'communities.id')
                                        // ->where('users.id', Auth::id())
                                        ->first();

            $communityModel->content = $request->content;
            $communityModel->img = $filepath;
            // $communityModel->user_id = Auth::id();
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

    public function communityGet() {
        $communityData = Community::select('communities.*', 'user.nick_name')
                                    ->join('users', 'users.id', '=', 'communities.user_id')
                                    ->orderBy('communities.id', 'DESC')
                                    ->get();
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $communityData->toArray()
        ];
        
        return response()->json($responseData, 200);
    }
}
