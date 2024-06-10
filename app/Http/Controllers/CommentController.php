<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // 댓글 작성
    public function comment(Request $request) {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('comment'),
            [
                'comment' => ['required','min:1','max:1000'],
            ]
        );

        // 유효성 검사 실패 체크
        if($validator->fails()){ // 실패했으면 true
            Log::debug('유효성 검사 실패 : ', $validator->errors()->toArray()); //로그의 첫번째 파라미터는 문자열이다
            throw new Exception('유효성 검사 실패');
        };
        
        $insertData = $request->only('comment');
        $insertData['user_id'] = 1;
        $insertData['camp_id'] = 1;

        $commentInsert = Comment::create($insertData);

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $commentInsert
        ];

        return response()->json($responseData, 200);
    }

    // 댓글 획득
    public function comment_get() {
        $commentData = Comment::select('comment')->orderBy('id', 'DESC')->get();

        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $commentData->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
