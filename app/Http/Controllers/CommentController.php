<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // 댓글 작성
    public function comment(Request $request, $id) {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('comment'),
            [
                'comment' => ['required','min:1','max:200'],
            ]
        );

        // 유효성 검사 실패 체크
        if($validator->fails()){ // 실패했으면 true
            Log::debug('유효성 검사 실패 : ', $validator->errors()->toArray()); //로그의 첫번째 파라미터는 문자열이다
            throw new Exception('유효성 검사 실패 댓글');
        };
        
        $insertData = $request->only('comment');
        $insertData['user_id'] = Auth::id();

        $campId = Camp::find($id);
        $insertData['camp_id'] = $campId->id;
        // Log::debug('캠프아이디', Camp::find($id)->toArray() );

        $commentInsert = Comment::create($insertData);

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $commentInsert
        ];

        return response()->json($responseData, 200);   
    }

    // 댓글 페이지네이션
    public function commentPaginate($id) {
        $comment = Comment::select('comments.*', 'users.nick_name')
                                ->join('users','users.id','=','comments.user_id')
                                ->where('camp_id','=',$id)
                                ->orderBy('comments.id', 'DESC')
                                ->paginate(5);
        // $comment = Comment::latest()->paginate(5);
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
