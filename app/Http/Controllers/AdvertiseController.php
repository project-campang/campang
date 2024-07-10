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
        // 요청에서 데이터 추출
        $data = $request->all();

        // 로직에 따라 데이터 처리
        $advertise = new Advertise();
        $advertise->id = $data['id']; // 프론트엔드에서 hidden 필드로 넘어온 user_id 사용
        $advertise->title = $data['title'];
        $advertise->type = $data['type'];
        $advertise->start_date = $data['start_date'];
        $advertise->end_date = $data['end_date'];
        $advertise->amount = $data['amount'];
        $advertise->content = $data['content'];
        $advertise->status = 1; // 기본적으로 '1'이 들어가야 함

        // 이미지 처리
        if ($request->hasFile('image')) {
            if ($advertise->profile) {
                Storage::disk('img_1')->delete($advertise->profile);
            }

            // 고유한 파일 이름 생성
            $file = $request->file('img_1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // 파일을 public/img 디렉터리에 저장
            $path = $file->move(public_path('img'), $filename);

            if ($path) {
                $advertise->profile = '/img/' . $filename;  // '/img/파일명.확장자'로 경로 설정
            } else {
                return response()->json(['message' => '파일 저장 실패'], 500);
            }
        } else {
            // 파일이 선택되지 않았을 때의 처리
            
        }

        // 데이터 저장
        $advertise->save();

        return response()->json(['message' => '광고 신청이 성공적으로 처리되었습니다.']);
    }

}