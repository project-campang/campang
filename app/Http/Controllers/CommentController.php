<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // 댓글 작성
    public function store(Request $request) {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('content', 'img'),
            [
                'title' => ['required', 'min:1', 'max:50'],
                'content' => ['required','min:1','max:1000'],
            ]
        );

        // 유효성 검사 실패 체크
        if($validator->fails()){ // 실패했으면 true
            Log::debug('유효성 검사 실패 : ', $validator->errors()->toArray()); //로그의 첫번째 파라미터는 문자열이다
            throw new MyValidateException('E01');
        };

        $insertData = $request->only('title', 'content');
        $insertData['user_id'] = 1;
        $insertData['board_id'] = 1;

        $commentInsert = Comment::create($insertData);

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $commentInsert
        ];

        return response()->json($responseData, 200);
    }
}
