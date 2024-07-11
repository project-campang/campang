<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Advertise;
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

}