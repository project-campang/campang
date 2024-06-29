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
   // 게시글 획득
    public function communityGet($id) {
        $boardList = Community::join('users', 'communities.user_id', '=', 'users.id')
                              ->select('communities.*', 'users.name')
                              ->where('communities.type', $id)
                              ->orderBy('communities.id', 'DESC')
                              ->paginate(5);
        
        $responseData= [
            'code' => '0',
            'msg' => '게시글 획득',
            'data' => $boardList
        ];
    
        return response()->json($responseData, 200);
    }
    
    // 게시글 조회순으로 획득 






    // 게시글 작성
    public function communityStore(Request $request, $id) {
        // 유효성 체크
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:1|max:50',
                'content' => 'required|min:1|max:500',
                'main_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
    
        if ($validator->fails()) {
            Log::debug('커뮤니티 페이지 유효성 검사 실패', $validator->errors()->toArray());
            throw new MyValidateException('E01');
        }
    
        // 파일 저장 경로
        $mainImgPath = null;
        if ($request->hasFile('main_img')) {
            $image = $request->file('main_img');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->move(public_path('img'), $fileName);
    
            // 경로를 '/img/파일이름' 형식으로 변경
            $mainImgPath = '/img/' . $fileName;
            Log::debug('main_img 저장 경로', ['path' => $mainImgPath]);
        } else {
            Log::debug('main_img 파일이 존재하지 않음');
        }
    
        // 게시글 저장
        $community = new Community;
        $community->type = $id; // 보드 ID 설정
        $community->title = $request->title;
        $community->content = $request->content;
        $community->main_img = $mainImgPath;
        $community->user_id = auth()->id(); // 현재 로그인된 사용자의 ID를 설정합니다.
        $community->views = 0;
        $community->save();
    
        // 응답 데이터 생성
        $responseData = [
            'code' => '0',
            'msg' => '게시글 작성 완료',
            'data' => $community->toArray()
        ];
    
        Log::debug('쿼리', $community->toArray());
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
    public function mainTip(Request $request) {
        $RankData = Community::select('communities.title', 'users.name')
                        ->join('users', 'users.id', '=', 'communities.user_id')
                        ->where('communities.type', '=', 4)
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
        $RankData = Community::select('*')
                        ->where('type', '=', 1) // type이 2인 데이터만 가져옴
                        ->where('user_id', '=', $userId) // 현재 로그인한 사용자의 게시글만 가져옴
                        ->whereNull('communities.deleted_at')
                        ->orderBy('views', 'DESC') // views 기준 내림차순 정렬
                        ->get();
    
        // 로그: 가져온 게시글 수 확인
        Log::info("Fetched {$RankData->count()} posts for user ID: {$userId}");
    
       

    
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $RankData->toArray(),
        ];
    
        return response()->json($responseData, 200);
    }
    
    
    
    public function ReviewGet(Request $request) {
    // 로그인한 사용자의 ID를 가져옵니다.
    $userId = auth()->id();

    // 사용자가 작성한 게시글 중 communities.type이 2인 데이터만 가져옵니다.
    $RankData = Community::select(
                'communities.id',
                'communities.title',
                'communities.content',
                'communities.main_img',
                'communities.other_img2',
                'communities.other_img3',
                'communities.other_img4',
                'communities.other_img5',
                'communities.views',
                'communities.created_at',
                'camps.name as camp_name' // camps 테이블에서 name 컬럼을 camp_name으로 가져옴
            )
            ->leftJoin('camps', 'communities.camp_id', '=', 'camps.id') // camps와의 조인
            ->where('communities.type', '=', 2) // type이 2인 데이터만 가져옴
            ->where('communities.user_id', '=', $userId) // 현재 로그인한 사용자의 게시글만 가져옴
            ->whereNull('communities.deleted_at')
            ->orderBy('communities.created_at', 'DESC') 
            ->get();


    $responseData = [
        'code' => '0',
        'msg' => '게시글 획득 완료',
        'data' =>  $RankData->toArray(),
    ];

    return response()->json($responseData, 200);
}

    
  
        public function updateContent(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'main_img' => 'nullable|image',
            'other_img2' => 'nullable|image',
            'other_img3' => 'nullable|image',
            'other_img4' => 'nullable|image',
            'other_img5' => 'nullable|image',
        ]);

        $content = Community::findOrFail($validatedData['id']);
        $content->title = $validatedData['title'];
        $content->content = $validatedData['content'];

        // 이미지 저장 경로 설정
        // $imagePath = 'img';

        if ($request->hasFile('main_img')) {
            // 기존 파일 삭제 후 저장
            if ($content->main_img) {
                Storage::disk('public')->delete($content->main_img);
            }
            // 파일 이름 설정
            $main_img = $request->file('main_img');
            $main_img_name = uniqid() . '.' . $main_img->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $main_img->move(public_path('img'), $main_img_name);
            // 데이터베이스에 파일 경로 저장
            $content->main_img = '/img/' . $main_img_name;
        }

        if ($request->hasFile('other_img2')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img2) {
                Storage::disk('public')->delete($content->other_img2);
            }
            // 파일 이름 설정
            $other_img2 = $request->file('other_img2');
            $other_img2_name = uniqid() . '.' . $other_img2->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img2->move(public_path('img'), $other_img2_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img2 = '/img/' . $other_img2_name;
        }

        if ($request->hasFile('other_img3')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img3) {
                Storage::disk('public')->delete($content->other_img3);
            }
            // 파일 이름 설정
            $other_img3 = $request->file('other_img3');
            $other_img3_name = uniqid() . '.' . $other_img3->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img3->move(public_path('img'), $other_img3_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img3 = '/img/' . $other_img3_name;
        }

        if ($request->hasFile('other_img4')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img4) {
                Storage::disk('public')->delete($content->other_img4);
            }
            // 파일 이름 설정
            $other_img4 = $request->file('other_img4');
            $other_img4_name = uniqid() . '.' . $other_img4->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img4->move(public_path('img'),$other_img4_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img4 = '/img/' . $other_img4_name;
        }

        if ($request->hasFile('other_img5')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img5) {
                Storage::disk('public')->delete($content->other_img5);
            }
            // 파일 이름 설정
            $other_img5 = $request->file('other_img5');
            $other_img5_name = uniqid() . '.' . $other_img5->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img5->move(public_path('img'),$other_img5_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img5 = '/img/' . $other_img5_name;
        }

        $content->save();

        return response()->json($content);
    }
    

    public function updateReview(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'main_img' => 'nullable|image',
            'other_img2' => 'nullable|image',
            'other_img3' => 'nullable|image',
            'other_img4' => 'nullable|image',
            'other_img5' => 'nullable|image',
        ]);
        // Log::debug('test', print_r($validatedData, true));
        $content = Community::findOrFail($validatedData['id']);
        $content->title = $validatedData['title'];
        $content->content = $validatedData['content'];
    
        // 이미지 저장 경로 설정
        // $imagePath = 'img';
    
        if ($request->hasFile('main_img')) {
            // 기존 파일 삭제 후 저장
            if ($content->main_img) {
                Storage::disk('public')->delete($content->main_img);
            }
            // 파일 이름 설정
            $main_img = $request->file('main_img');
            $main_img_name = uniqid() . '.' . $main_img->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $main_img->move(public_path('img'), $main_img_name);
            // 데이터베이스에 파일 경로 저장
            $content->main_img = '/img/' . $main_img_name;
        }
    
        if ($request->hasFile('other_img2')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img2) {
                Storage::disk('public')->delete($content->other_img2);
            }
            // 파일 이름 설정
            $other_img2 = $request->file('other_img2');
            $other_img2_name = uniqid() . '.' . $other_img2->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img2->move(public_path('img'), $other_img2_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img2 = '/img/' . $other_img2_name;
        }
    
        if ($request->hasFile('other_img3')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img3) {
                Storage::disk('public')->delete($content->other_img3);
            }
            // 파일 이름 설정
            $other_img3 = $request->file('other_img3');
            $other_img3_name = uniqid() . '.' . $other_img3->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img3->move(public_path('img'), $other_img3_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img3 = '/img/' . $other_img3_name;
        }
    
        if ($request->hasFile('other_img4')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img4) {
                Storage::disk('public')->delete($content->other_img4);
            }
            // 파일 이름 설정
            $other_img4 = $request->file('other_img4');
            $other_img4_name = uniqid() . '.' . $other_img4->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img4->move(public_path('img'),$other_img4_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img4 = '/img/' . $other_img4_name;
        }
    
        if ($request->hasFile('other_img5')) {
            // 기존 파일 삭제 후 저장
            if ($content->other_img5) {
                Storage::disk('public')->delete($content->other_img5);
            }
            // 파일 이름 설정
            $other_img5 = $request->file('other_img5');
            $other_img5_name = uniqid() . '.' . $other_img5->getClientOriginalExtension();
            // 파일을 public/img 디렉터리에 저장
            $other_img5->move(public_path('img'),$other_img5_name);
            // 데이터베이스에 파일 경로 저장
            $content->other_img5 = '/img/' . $other_img5_name;
        }
    
        $content->save();
    
        return response()->json($content);
    }


    public function deletePost(Request $request, $id)
    {
        Log::debug('Delete request received for post ID: ' . $id);

        try {
            // 게시글 찾기
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
    

