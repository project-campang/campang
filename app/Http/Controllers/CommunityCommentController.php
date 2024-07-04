<?php

namespace App\Http\Controllers;

use App\Models\CommunityComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommunityCommentController extends Controller
{
    public function communityComment($id) {
        $boardList = CommunityComment::join('users', 'community_comments.user_id', '=', 'users.id')
                              ->select('community_comments.comment', 'community_comments.created_at', 'users.name', 'users.nick_name', 'community_comments.user_id', 'community_comments.id')
                              ->where('community_comments.community_id', $id)
                              ->orderBy('community_comments.id', 'DESC')
                              ->paginate(5);
    
        $responseData = [
            'code' => '0',
            'msg' => '댓글 획득',
            'data' => $boardList->items(),
            'pagination' => [
                'current_page' => $boardList->currentPage(),
                'first_page_url' => $boardList->url(1),
                'last_page' => $boardList->lastPage(),
                'last_page_url' => $boardList->url($boardList->lastPage()),
                'total' => $boardList->total(),
                'per_page' => $boardList->perPage(),
                'prev_page_url' => $boardList->previousPageUrl(),
                'next_page_url' => $boardList->nextPageUrl(),
                'links' => $boardList->links()
            ]
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
        $userId = auth()->id();
        // Log::debug($request);
    
        $request->validate([
            'community_id' => 'required|integer|exists:communities,id',
            'comment' => 'required|string|max:1000',
        ]);
    
        $comment = CommunityComment::create([
            'community_id' => $id,
            'user_id' => $userId,
            'comment' => $request->input('comment'),
        ]);
    
        return response()->json($comment, 200);
    }

    public function commentUpdate(Request $request, $id){

        try {
            $comment = CommunityComment::findOrFail($id);
            $comment->comment = $request->input('comment');
            $comment->save();

            return response()->json(['message' => '댓글이 성공적으로 업데이트되었습니다']);
        } catch (\Exception $e) {
            return response()->json(['error' => '댓글 업데이트 중 오류 발생'], 500);
        }
        
    }
    public function commentDelete($id)
    {
        try {
            $comment = CommunityComment::findOrFail($id);
            $comment->delete();

            return response()->json(['message' => '댓글이 성공적으로 삭제되었습니다']);
        } catch (\Exception $e) {
            return response()->json(['error' => '댓글 삭제 중 오류 발생'], 500);
        }
    }
    
    
}
