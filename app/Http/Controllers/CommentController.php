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
            throw new Exception('유효성 검사 실패');
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

    public function CommentGet(Request $request) {
        // 로그인한 사용자의 ID를 가져옵니다.
        $userId = auth()->id();
    
    
        // 사용자가 작성한 게시글 중 communities.type이 2인 데이터만 가져옵니다.
        $RankData = Comment::select('comments.*')
                        ->where('user_id', '=', $userId) // 현재 로그인한 사용자의 게시글만 가져옴
                        ->whereNull('deleted_at')
                        ->orderBy('created_at', 'DESC')
                        ->get();
    
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $RankData->toArray()
        ];
    
        return response()->json($responseData, 200);
    }

    public function deleteComment(Request $request, $id)
    {
        try {
            // 리뷰 찾기
            $Comment = Comment::findOrFail($id);

            // 리뷰 삭제
            $Comment->delete();

            // 성공 응답 반환
            return response()->json(['message' => '리뷰가 성공적으로 삭제되었습니다.'], 200);
        } catch (\Exception $e) {
            // 에러 응답 반환
            return response()->json(['message' => '리뷰 삭제 중 오류가 발생했습니다.', 'error' => $e->getMessage()], 500);
        }
    }
}
