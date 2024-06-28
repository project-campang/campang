<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use Exception;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{

    //  게시글 획득
    public function communityGet($types) {

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
        
        $types = ['1', '2','3','4','5']; // 게시판 타입

        // 게시글 정보 획득
        $boardList = Community::join('users', 'communities.user_id', '=', 'users.id')
                                ->select('communities.*', 'users.name')
                                ->where('communities.type', '=' , $types)
                                ->orderBy('communities.id', 'DESC')
                                ->paginate(5);
        // log::debug('게시글 정보', $boardList);
        Log::debug("boardList", $boardList->toArray());
        
        $responseData= [
            'code' => '0'
            ,'msg' => '게시글 획득'
            // ,'data' => $boardList->toArray()
            ,'data' => $boardList->toArray()
        ];

        // log::debug('responseData1', $responseData);

        // $communityData = Community::select('communities.*', 'users.nick_name')
        //                             ->join('users', 'users.id', '=', 'communities.user_id')
        //                             ->orderBy('communities.id', 'DESC')
        //                             ->limit(8)
        //                             ->get();
        // $responseData = [
        //     'code' => '0',
        //     'msg' => '게시글 획득 완료',
        //     'data' => $communityData->toArray()
        // ];
        // Log::debug('쿼리', $communityData->toArray());
        // Log::debug('responseData2', $responseData);
        // Log::debug('리턴');
        
        return response()->json($responseData, 200);
    }

    // 게시글 조회순으로 획득 





    // 게시글 작성
    public function communityStore(Request $request) {

        // 유효성 체크용 데이터 초기화
        $requestData = [
            'title' => $request->title
            ,'content' => $request->content
            ,'main_img' => $request->mainImg
            ,'views' => $request->views
        ];

        // 유효성 체크
        $validator = Validator::make(
            $request->only('title', 'content', 'main_img')
            // $request->all()
            ,[
                // 'type' => ['required']
                'title' => ['required', 'min:1', 'max:50']
                ,'content' => ['required', 'min:1', 'max:500']
                ,'main_img' => ['image']
                ,'views' => ['required']
            ]
        );

        // 유효성 검사 실패 시 처리
        if($validator->fails()) {
            Log::debug('---', $validator->errors()->toArray());
            Log::debug('커뮤니티 페이지 유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01');
        }

        Log::debug('유효성 검사 통과', $validator->errors()->toArray());

        // 파일 저장
        // if($request->hasFile('main_img')) {
        //     $mainImgPath = $request->file('main_img')->store('main_img');
        // }

        $mainImgPath = null;
        if($request->hasFile('main_img')) {
            $mainImgPath = $request->file('main_img')->store('main_img');
            Log::debug('main_img 저장 경로', ['path' => $mainImgPath]);
        }
        else {
            Log::debug('main_img 파일이 존재하지 않음');
        }
        // Log::('유효성 검사 패스', $mainImgPath);

        // insert 데이터 생성
        // $communityRequest = Community::select('communities.*', 'users.id')
        //                             ->join('users','users.id','=','communities.user_id')
        //                             ->where('users.id', Auth::id())
        //                             ->first();

        $communityRequest = Community::select('communities.*', 'users.nick_name')
                                    ->join('users', 'communities.user_id', '=', 'users.id')
                                    ->first();

        if ($communityRequest === null) {
            return response()->json([
                'code' => 'E99',
                'msg' => '해당 사용자의 게시글을 찾을 수 없습니다.',
            ], 404);
        }
                  
        // 인스턴스
        $communityRequest = new Community;
        $communityRequest->title = $request->title;
        $communityRequest->content = $request->content;
        $communityRequest->main_img = $mainImgPath;
        $communityRequest->user_id = 1;
        $communityRequest->views = 0;
        $communityRequest->save();

        // $insertData = $request->only('comment');
        // $insertData['user_id'] = 1;
        // $insertData['camp_id'] = 1;
        
        // response 처리
        $responseData = [
            'code' => '0'
            ,'msg' => '게시글 작성 완료'
            ,'data' => $communityRequest->toArray()
        ];

        Log::debug('쿼리', $communityRequest->toArray());
        Log::debug('responseData2', $responseData);
        Log::debug('리턴');

        // 리턴
        return response()->json($responseData, 200);
    }

    // // 게시글 조회수 증가
    // public function incrementViews(Request $request, $id) {
    //     try {
    //         // 게시글을 ID로 찾기
    //         $community = Community::find($id);
    
    //         // 게시글이 존재하는지 확인
    //         if (!$community) {
    //             return response()->json([
    //                 'code' => 'E99',
    //                 'msg' => '게시글을 찾을 수 없습니다.'
    //             ], 404);
    //         }

    //         // 조회수 증가
    //         $community->views += 1;
    //         $community->save();

    //         return response()->json([
    //             'code' => '0',
    //             'msg' => '조회수가 증가했습니다.',
    //             'data' => $community->toArray()
    //         ], 200);

    //     } catch (Exception $e) {
    //         return response()->json([
    //             'code' => 'E01',
    //             'msg' => '조회수 증가 중 오류가 발생했습니다.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // 게시글 수정
    // public function communityStore(Request $request) {

    //     // 유효성 체크용 데이터 초기화
    //     $requestData = [
    //         'title' => $request->title
    //         ,'content' => $request->content
    //         ,'main_img' => $request->mainImg
    //     ];

    //     // 유효성 체크
    //     $validator = Validator::make(
    //         $request->only('title', 'content', 'main_img')
    //         // $request->all()
    //         ,[
    //             // 'type' => ['required']
    //             'title' => ['required', 'min:1', 'max:50']
    //             ,'content' => ['required', 'min:1', 'max:500']
    //             ,'main_img' => ['image']
    //         ]
    //     );

    //     // 유효성 검사 실패 시 처리
    //     if($validator->fails()) {
    //         Log::debug('---', $validator->errors()->toArray());
    //         Log::debug('유효성 검사 실패', $validator->errors()->toArray());
    //         throw new MyValidateException('E01');
    //     }

    //     Log::debug('유효성 검사 통과', $validator->errors()->toArray());

    //     // 파일 저장
    //     // if($request->hasFile('main_img')) {
    //     //     $mainImgPath = $request->file('main_img')->store('main_img');
    //     // }

    //     $mainImgPath = null;
    //     if($request->hasFile('main_img')) {
    //         $mainImgPath = $request->file('main_img')->store('main_img');
    //         Log::debug('main_img 저장 경로', ['path' => $mainImgPath]);
    //     }
    //     else {
    //         Log::debug('main_img 파일이 존재하지 않음');
    //     }
    //     // Log::('유효성 검사 패스', $mainImgPath);

    //     // insert 데이터 생성
    //     // $communityRequest = Community::select('communities.*', 'users.id')
    //     //                             ->join('users','users.id','=','communities.user_id')
    //     //                             ->where('users.id', Auth::id())
    //     //                             ->first();

    //     $communityRequest = Community::select('communities.*', 'users.nick_name')
    //                                 ->join('users', 'communities.user_id', '=', 'users.id')
    //                                 ->first();

    //     if ($communityRequest === null) {
    //         return response()->json([
    //             'code' => 'E99',
    //             'msg' => '해당 사용자의 게시글을 찾을 수 없습니다.',
    //         ], 404);
    //     }
                                    
    //     $communityRequest->title = $request->title;
    //     $communityRequest->content = $request->content;
    //     $communityRequest->main_img = $mainImgPath;
    //     $communityRequest->user_id = 1;
    //     $communityRequest->save();

    //     // $insertData = $request->only('comment');
    //     // $insertData['user_id'] = 1;
    //     // $insertData['camp_id'] = 1;
        
    //     // response 처리
    //     $responseData = [
    //         'code' => '0'
    //         ,'msg' => '게시글 작성 완료'
    //         ,'data' => $communityRequest->toArray()
    //     ];

    //     Log::debug('쿼리', $communityRequest->toArray());
    //     Log::debug('responseData2', $responseData);
    //     Log::debug('리턴');

    //     // 리턴
    //     return response()->json($responseData, 200);
    // }


    // 게시글 삭제












    // 상세페이지 리뷰 목록 가져오기
    public function detailReviewGet() {
        $data = Community::select('communities.*', 'users.nick_name')
                            ->join('users', 'users.id', '=', 'communities.user_id')
                            ->where('type', '=', 2)
                            ->orderBy('communities.rating', 'DESC')
                            ->paginate(3);

        Log::debug("review", $data->toArray());
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $data->toArray()
        ];
        
        return response()->json($responseData, 200);
    }




    // 서린 메인 커뮤글
    public function mainCommunity(Request $request) {
        $RankData = Community::select('communities.title', 'users.name')
                        ->join('users', 'users.id', '=', 'communities.user_id')
                        ->where('communities.type', '<>', 2) // type이 2인 것 제외
                        ->whereNull('communities.deleted_at')
                        ->orderBy('communities.views', 'DESC') // views 기준 내림차순 정렬
                        ->take(5) // 최대 5개의 결과만 가져옴
                        ->get();
    
        // Log::debug('RankData', $RankData->toArray());
    
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $RankData->toArray()
        ];
    
        return response()->json($responseData, 200);
    }


    public function contentGet(Request $request) {
        // 로그인한 사용자의 ID를 가져옵니다.
        $userId = auth()->id();
    
        // 사용자의 nick_name을 가져옵니다.
        $userNickName = auth()->user()->nick_name;
    
        // 로그: 사용자 ID와 닉네임 확인
        Log::info("User ID: {$userId}, Nickname: {$userNickName}");
    
        // 사용자가 작성한 게시글 중 communities.type이 2인 데이터만 가져옵니다.
        $RankData = Community::
                        where('type', '=', 1) // type이 2인 데이터만 가져옴
                        ->where('user_id', '=', $userId) // 현재 로그인한 사용자의 게시글만 가져옴
                        ->whereNull('communities.deleted_at')
                        ->orderBy('views', 'DESC') // views 기준 내림차순 정렬
                        ->get();
    
        // 로그: 가져온 게시글 수 확인
        Log::info("Fetched {$RankData->count()} posts for user ID: {$userId}");
    
        // 각 항목에 사용자의 닉네임을 추가하여 배열로 변환
        $formattedRankData = $RankData->map(function ($item) use ($userNickName) {
            $item->user_nick_name = $userNickName;
            return $item;
        });
    
        // 로그: 변환된 데이터 확인
        Log::info("Formatted data for user ID: {$userId}: " . json_encode($formattedRankData));
    
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $formattedRankData->toArray(),
        ];
    
        return response()->json($responseData, 200);
    }
    
    
    
    public function ReviewGet(Request $request) {
         // 로그인한 사용자의 ID를 가져옵니다.
         $userId = auth()->id();
    
         // 사용자의 nick_name을 가져옵니다.
         $userNickName = auth()->user()->nick_name;
     
         // 사용자가 작성한 게시글 중 communities.type이 2인 데이터만 가져옵니다.
         $RankData = Community::
                leftJoin('camps', 'communities.camp_id', '=', 'camps.id') // camps와의 조인
                ->where('communities.type', '=', 2) // type이 2인 데이터만 가져옴
                ->where('communities.user_id', '=', $userId) // 현재 로그인한 사용자의 게시글만 가져옴
                ->whereNull('communities.deleted_at')
                ->orderBy('communities.views', 'DESC') // views 기준 내림차순 정렬
                ->get();
     
         // 각 항목에 사용자의 닉네임을 추가하여 배열로 변환
         $formattedRankData = $RankData->map(function ($item) use ($userNickName) {
             $item->user_nick_name = $userNickName;
             return $item;
         });
     
         $responseData = [
             'code' => '0',
             'msg' => '게시글 획득 완료',
             'data' => $formattedRankData->toArray(),
         ];
     
         return response()->json($responseData, 200);
    }
    
    public function updatePost(Request $request)
    {
        // 요청에서 필요한 데이터 추출
        $postId = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');

        // 게시글 업데이트
        $post = Community::find($postId);
        if (!$post) {
            return response()->json(['error' => '게시글을 찾을 수 없습니다.'], 500);
        }

        $post->title = $title;
        $post->content = $content;

        // 메인 이미지 업데이트 처리
        if ($request->hasFile('main_img')) {
            $mainImgPath = $request->file('main_img')->store('public/img');
            $post->main_img = Storage::url($mainImgPath);
        }

        // 부가 이미지 업데이트 처리 (필요한 만큼 추가)
        if ($request->hasFile('other_img2')) {
            $otherImg2Path = $request->file('other_img2')->store('public/img');
            $post->other_img2 = Storage::url($otherImg2Path);
        }
        if ($request->hasFile('other_img3')) {
            $otherImg3Path = $request->file('other_img3')->store('public/img');
            $post->other_img3 = Storage::url($otherImg3Path);
        }
        if ($request->hasFile('other_img4')) {
            $otherImg4Path = $request->file('other_img4')->store('public/img');
            $post->other_img4 = Storage::url($otherImg4Path);
        }
        if ($request->hasFile('other_img5')) {
            $otherImg5Path = $request->file('other_img5')->store('public/img');
            $post->other_img5 = Storage::url($otherImg5Path);
        }

        $post->save();

        return response()->json(['message' => '게시글이 성공적으로 업데이트되었습니다.']);
    }


    public function updateReview(Request $request)
    {
        // 요청에서 필요한 데이터 추출
        $postId = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');

        // 리뷰 업데이트
        $review = Community::find($postId);
        if (!$review) {
            return response()->json(['error' => '리뷰를 찾을 수 없습니다.'], 500);
        }

        $review->title = $title;
        $review->content = $content;

        // 메인 이미지 업데이트 처리
        if ($request->hasFile('main_img')) {
            $mainImgPath = $request->file('main_img')->store('public/img');
            $review->main_img = Storage::url($mainImgPath);
        }

        // 부가 이미지 업데이트 처리 (필요한 만큼 추가)
        if ($request->hasFile('other_img2')) {
            $otherImg2Path = $request->file('other_img2')->store('public/img');
            $review->other_img2 = Storage::url($otherImg2Path);
        }
        if ($request->hasFile('other_img3')) {
            $otherImg3Path = $request->file('other_img3')->store('public/img');
            $review->other_img3 = Storage::url($otherImg3Path);
        }
        if ($request->hasFile('other_img4')) {
            $otherImg4Path = $request->file('other_img4')->store('public/img');
            $review->other_img4 = Storage::url($otherImg4Path);
        }
        if ($request->hasFile('other_img5')) {
            $otherImg5Path = $request->file('other_img5')->store('public/img');
            $review->other_img5 = Storage::url($otherImg5Path);
        }

        $review->save();

        return response()->json(['message' => '리뷰가 성공적으로 업데이트되었습니다.']);
    }
    

        public function deletePost(Request $request, $id)
    {
        Log::debug('Delete request received for post ID: ' . $id);

        try {
            // 리뷰 찾기
            $Post = Community::findOrFail($id);

            Log::debug('Post found: ' . json_encode($Post));

            // 리뷰 삭제
            $Post->delete();

            Log::info('Post deleted successfully: ' . json_encode($Post));

            // 성공 응답 반환
            return response()->json(['message' => '리뷰가 성공적으로 삭제되었습니다.'], 200);
        } catch (\Exception $e) {
            // 에러 로깅
            Log::error('Error deleting post: ' . $e->getMessage());

            // 에러 응답 반환
            return response()->json(['message' => '리뷰 삭제 중 오류가 발생했습니다.', 'error' => $e->getMessage()], 500);
        }
    }


    public function deleteReview(Request $request, $id)
    {
        Log::debug('Delete request received for post ID: ' . $id);

        try {
            // 리뷰 찾기
            $Post = Community::findOrFail($id);

            Log::debug('Post found: ' . json_encode($Post));

            // 리뷰 삭제
            $Post->delete();

            Log::info('Post deleted successfully: ' . json_encode($Post));

            // 성공 응답 반환
            return response()->json(['message' => '리뷰가 성공적으로 삭제되었습니다.'], 200);
        } catch (\Exception $e) {
            // 에러 로깅
            Log::error('Error deleting post: ' . $e->getMessage());

            // 에러 응답 반환
            return response()->json(['message' => '리뷰 삭제 중 오류가 발생했습니다.', 'error' => $e->getMessage()], 500);
        }
    }






    
}
    

