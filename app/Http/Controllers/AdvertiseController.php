<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Advertise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvertiseController extends Controller
{
    public function submitAdForm(Request $request)
    {   
        
       // 현재 인증된 사용자의 id 가져오기
        $user_id = Auth::id();

        // 요청에서 데이터 추출
        $data = $request->all();
        Log::debug($data);

        // amount에서 ₩와 쉼표(,) 제거하고 숫자만 남기기
        $amountString = $data['amount'];
        $amountString = str_replace(['₩', ',', ' '], '', $amountString);
        $amount = (float) $amountString; // 부동 소수점 형식으로 변환

        // 광고 등록 처리
        $advertise = new Advertise();
        $advertise->user_id = $user_id;
        $advertise->title = $data['title'];
        $advertise->ad_type = $data['ad_type'];
        $advertise->start_date = $data['start_date'];
        $advertise->end_date = $data['end_date'];
        $advertise->amount = $amount; // 숫자로 변환한 amount 저장
        $advertise->content = $data['content'];
        $advertise->status = 1;

        // 이미지 처리
        if ($request->hasFile('img_1')) {
            // 기존 프로필 사진 삭제
            if ($advertise->img_1) {
                Storage::disk('public')->delete($advertise->img_1);
            }
    
            // 파일을 저장하고 경로를 설정
            $file = $request->file('img_1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('img'), $filename); // public/img 디렉터리에 저장
    
            if ($path) {
                $advertise->img_1 = '/img/' . $filename; // 저장된 파일의 상대 경로
            } else {
                return response()->json(['message' => '파일 저장 실패'], 200);
            }
        }

        // 데이터 저장
        $advertise->save();

        return response()->json(['message' => '광고 신청이 성공적으로 처리되었습니다.']);
    }


    // 마이페이지 내광고
    public function myadverTisement(Request $request)
    {
        // 로그인한 사용자의 ID를 가져옵니다.
        $userId = auth()->id();

        // 로그인한 사용자의 광고만 조회합니다.
        $boardList = Advertise::join('users', 'advertises.user_id', '=', 'users.id')
                            ->select('advertises.*', 'users.name', 'users.nick_name')
                            ->where('advertises.user_id', $userId)
                            ->orderBy('advertises.created_at', 'DESC')
                            ->get();

        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득',
            'data' => $boardList
        ];

        return response()->json($responseData, 200);
    }

    // 관리자페이지 광고
    public function advertiseManagement(Request $request)
    {
        $adType = $request->query('ad_type'); // ad_type 파라미터 가져오기
        
        $query = Advertise::query();

        if ($adType !== null) {
            $query->where('ad_type', $adType);
        }

        $boardList = $query->orderBy('created_at', 'DESC')->get();
        
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득',
            'data' => $boardList
        ];

        return response()->json($responseData, 200);
    }
    //관리자페이지 광고수정
    public function updateAdvertisement(Request $request)
{
    $requestData = $request->all();

    // 광고 ID
    $advertisementId = $requestData['id'];

        // 업데이트할 광고 정보
        $advertisement = Advertise::findOrFail($advertisementId);

        // 요청으로부터 받은 필드들 업데이트
        $advertisement->title = $requestData['title'];
        $advertisement->start_date = $requestData['start_date'];
        $advertisement->end_date = $requestData['end_date'];
        $advertisement->amount = $requestData['amount'];
        $advertisement->status = $requestData['status'];
        $advertisement->order = $requestData['order'];

        // 이미지 업로드 처리
        if ($request->has('img_1') && Str::startsWith($requestData['img_1'], 'data:image')) {
            // Decode the base64 image
            $imgData = substr($requestData['img_1'], strpos($requestData['img_1'], ',') + 1);
            $image = base64_decode($imgData);

            // Generate unique file name for image
            $imageName = time() . '.png';

            // Save image to public/img directory
            $filePath = public_path('img') . '/' . $imageName;
            file_put_contents($filePath, $image);

            // Update advertisement model with image path
            $advertisement->img_1 = '/img/' . $imageName;
        }

        if ($request->has('img_2') && Str::startsWith($requestData['img_2'], 'data:image')) {
            // Decode the base64 image
            $imgData = substr($requestData['img_2'], strpos($requestData['img_2'], ',') + 1);
            $image = base64_decode($imgData);

            // Generate unique file name for image
            $imageName = time() . '_2.png';

            // Save image to public/img directory
            $filePath = public_path('img') . '/' . $imageName;
            file_put_contents($filePath, $image);

            // Update advertisement model with image path
            $advertisement->img_2 = '/img/' . $imageName;
        }

        if ($request->has('img_3') && Str::startsWith($requestData['img_3'], 'data:image')) {
            // Decode the base64 image
            $imgData = substr($requestData['img_3'], strpos($requestData['img_3'], ',') + 1);
            $image = base64_decode($imgData);

            // Generate unique file name for image
            $imageName = time() . '_3.png';

            // Save image to public/img directory
            $filePath = public_path('img') . '/' . $imageName;
            file_put_contents($filePath, $image);

            // Update advertisement model with image path
            $advertisement->img_3 = '/img/' . $imageName;
        }

        // 광고 정보 저장
        $advertisement->save();

        // 업데이트된 광고 목록 조회
        $adType = $request->query('ad_type');
        $query = Advertise::query();
        if ($adType !== null) {
            $query->where('ad_type', $adType);
        }
        $updatedList = $query->orderBy('created_at', 'DESC')->get();

        // 응답 데이터 구성
        $responseData = [
            'code' => '0',
            'msg' => '광고 수정 완료',
            'data' => $updatedList
        ];

        return response()->json($responseData, 200);
    }


    // 광고취소
    public function cancelAdvertisement(Request $request)
    {
        $requestData = $request->all();
        $advertisementId = $requestData['id'];

        // 해당 ID의 광고를 찾아서 취소 처리
        $advertisement = Advertise::findOrFail($advertisementId);

        // deleted_at에 현재 시간을 설정하여 소프트 삭제
        $advertisement->deleted_at = now();
        
        // status를 4로 설정하여 취소 상태 표시
        $advertisement->status = 4;

        // 광고 정보 저장
        $advertisement->save();

        // 취소된 광고 목록 다시 조회
        $query = Advertise::query();
        $boardList = $query->orderBy('created_at', 'DESC')->get();

        $responseData = [
            'code' => '0',
            'msg' => '광고 취소 완료',
            'data' => $boardList
        ];

        return response()->json($responseData, 200);
    }
    // 배너 광고 관리
    public function advertiseAdd(Request $request)
    {
        $adType = $request->query('ad_type'); // ad_type 파라미터 가져오기
        
        $query = Advertise::query();
        
        // 필터링 조건 추가
        $query->where('status', '3')
            ->where(function ($query) {
                $query->where('start_date', '<=', now()) // start_date가 오늘이거나 오늘보다 작거나
                        ->orWhereNull('start_date'); // start_date가 NULL일 경우도 포함
            })
            ->where(function ($query) {
                $query->where('end_date', '>=', now()) // end_date가 오늘보다 작거나 오늘인 경우
                        ->orWhereNull('end_date'); // end_date가 NULL일 경우도 포함
            });
        
        if ($adType !== null) {
            $query->where('ad_type', $adType);
        }
        
        $boardList = $query->orderBy('created_at', 'DESC')->get();
        
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득',
            'data' => $boardList
        ];
        
        return response()->json($responseData, 200);
    }


    // 광고 캠핑장 데이터 불러오기
    public function getAds() {
        $date = Carbon::now();
        $ads = Advertise::select('*')->where('start_date','<=',$date)->where('end_date','>=',$date)->where('status','3')->where('ad_type','0')->orderBy('order','ASC')->get();

        $responseData = [
            'code'=> '0',
            'msg' => '게시할광고 획득완료',
            'data' => $ads
        ];

        return response()->json($responseData, 200);
    }

    //광고 캠핑장 브랜드 데이터 불러오기
    public function getBrandAds() {
        $date = Carbon::now();
        $ads = Advertise::select('*')->where('start_date','<=',$date)->where('end_date','>=',$date)->where('status','3')->where('ad_type','1')->orderBy('order','ASC')->get();

        $responseData = [
            'code'=> '0',
            'msg' => '게시할 브랜드광고 획득완료',
            'data' => $ads
        ];

        return response()->json($responseData, 200);
    }
}


    


