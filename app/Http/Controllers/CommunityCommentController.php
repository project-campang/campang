<?php

namespace App\Http\Controllers;

use App\Models\CommunityComment;
use Illuminate\Http\Request;

class CommunityCommentController extends Controller
{
    public function communityComment($id) {
        $boardList = CommunityComment::join('users', 'community_comments.user_id', '=', 'users.id')
                              ->select('community_comments.comment', 'community_comments.created_at', 'users.name', 'users.nick_name')
                              ->where('community_comments.community_id', $id)
                              ->orderBy('community_comments.id', 'DESC')
                              ->paginate(5);
    
        $responseData = [
            'code' => '0',
            'msg' => '댓글 획득',
            'data' => $boardList
        ];
    
        return response()->json($responseData, 200);
    }
    
    // public function commentInsert($id) {
    //     $boardList = CommunityComment::join('users', 'community_comments.user_id', '=', 'users.id')
    //                           ->select('community_comments.comment', 'community_comments.created_at', 'users.name', 'users.nick_name')
    //                           ->where('community_comments.community_id', $id)
    //                           ->orderBy('community_comments.id', 'DESC')
    //                           ->paginate(5);
    
    //     $responseData = [
    //         'code' => '0',
    //         'msg' => '댓글 획득',
    //         'data' => $boardList
    //     ];
    
    //     return response()->json($responseData, 200);
    // }

    public function commentInsert(Request $request, $id) {
        // 현재 로그인한 사용자 ID
        $userId = auth()->id();
        
        // 요청 데이터 유효성 검사
        $request->validate([
            'community_id' => 'required|integer|exists:communities,id',
            'comment' => 'required|string|max:1000',
        ]);
    
        // 새로운 댓글 저장
        $comment = CommunityComment::create([
            'community_id' => $id,
            'user_id' => $userId,
            'comment' => $request->input('comment'),
        ]);
    
        // 성공 응답 반환
        return response()->json([
            'code' => '0',
            'msg' => '댓글 작성 성공',
            'data' => $comment
        ], 201);
    }
    
    
}
