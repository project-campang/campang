<?php

namespace App\Http\Controllers;

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
    public function commentGet() {
        $commentData = Comment::select('comments.*', 'users.nick_name')
                                ->join('users','users.id','=','comments.user_id')
                                ->orderBy('comments.id', 'DESC')
                                ->get();
        $responseData = [
            'code' => '0',
            'msg' => '댓글 획득 완료',
            'data' => $commentData->toArray()
            ];
        Log::debug('쿼리 작동됌', $commentData->toArray());
        Log::debug('responseData', $responseData);
        Log::debug('리턴');
        return response()->json($responseData, 200);
    }

    // 댓글 페이지네이션
    public function commentPaginate() {

        $comment = Comment::latest()->paginate(5);
        Log::debug("comment", $comment->toArray());

        $responseData = [
            'code' => '0',
            'msg' => '댓글페이지네이션획득',
            'data' => $comment->toArray()
            ];
        // Log::debug('response', $responseData);

        return response()->json($responseData, 200);
    }
}
