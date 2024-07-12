<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\State;
use App\Models\County
;
use App\Models\SiteType;
use App\Models\Topo;
use App\Models\Amenity;
use App\Models\Amusement;

use App\Models\CampSiteType;
use App\Models\CampTopo;
use App\Models\CampAmenity;
use App\Models\CampAmusement;

use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CampController extends Controller
{


    // 캠핑장 데이터 획득 + 페이지네이션
    public function campListGet(Request $request) {
        log::debug('campListGet', $request->all());

        
        $campList = Camp::select('camps.*')

        // 시/도
        ->join('states', 'camps.state', '=', 'states.name')
        // 군/구
        ->join('counties', 'camps.county', '=', 'counties.name')

        ->groupBy('camps.id', 'camps.name', 'camps.tel', 'camps.address', 'camps.state', 'camps.county', 'camps.latitude', 'camps.longitude', 'camps.info_text', 'camps.link', 'camps.price', 'camps.main_img', 'camps.other_img_1', 'camps.other_img_2', 'camps.other_img_3', 'camps.other_img_4', 'camps.other_img_5', 'camps.other_img_6', 'camps.other_img_7', 'camps.other_img_8', 'camps.other_img_9', 'camps.other_img_10', 'camps.created_at', 'camps.updated_at', 'camps.deleted_at')
        // ->orderBy('counties.name')
        ;
        // ->limit()
        
        if($request->has('state') && $request->state != '0') {
            $campList->where('states.id', $request->state);
        }
        if($request->has('county') && $request->county != '0') {
            $campList->where('counties.id', $request->county);
        }
        // 사이트 타입 필터링
        if ($request->has('site_type')) {
            $siteTypes = $request->site_type;

            $campList
                ->join('camp_site_types', function ($join) use ($siteTypes) {
                    $join->on('camps.id', '=', 'camp_site_types.camp_id')
                        ->whereIn('camp_site_types.site_type_no', $siteTypes); // 모든 선택된 사이트 타입 필터링
                })
                ->groupBy('camps.id') // 캠핑장 그룹화
                ->havingRaw('COUNT(DISTINCT camp_site_types.site_type_no) = ?', [count($siteTypes)]); // 포함 확인
        }

        // 지형/환경 필터링
        if ($request->has('topo')) {
            $topos = $request->topo;

            $campList
                ->join('camp_topos as ct1', function ($join) use ($topos) {
                    $join->on('camps.id', '=', 'ct1.camp_id')
                        ->whereIn('ct1.topo_no', $topos); // 선택된 모든 지형/환경 옵션에 대해 필터링
                })
                ->groupBy('camps.id') // 캠핑장을 그룹화합니다.
                ->havingRaw('COUNT(DISTINCT ct1.topo_no) = ?', [count($topos)]); // 모든 지형/환경 옵션을 포함하는지 확인합니다.
        }

        // 편의 시설 필터링
        if ($request->has('amenity')) {
            $amenities = $request->amenity;

            $campList
                ->join('camp_amenities as ca1', function ($join) use ($amenities) {
                    $join->on('camps.id', '=', 'ca1.camp_id')
                        ->whereIn('ca1.amenity_no', $amenities); // 선택된 모든 편의 시설 옵션에 대해 필터링
                })
                ->groupBy('camps.id') // 캠핑장을 그룹화합니다.
                ->havingRaw('COUNT(DISTINCT ca1.amenity_no) = ?', [count($amenities)]); // 모든 편의 시설 옵션을 포함하는지 확인합니다.
        }

        // 즐길거리 필터링
        if ($request->has('amusement')) {
            $amusements = $request->amusement;

            $campList
                ->join('camp_amusements as cam1', function ($join) use ($amusements) {
                    $join->on('camps.id', '=', 'cam1.camp_id')
                        ->whereIn('cam1.amusement_no', $amusements); // 선택된 모든 즐길거리 옵션에 대해 필터링
                })
                ->groupBy('camps.id') // 캠핑장을 그룹화합니다.
                ->havingRaw('COUNT(DISTINCT cam1.amusement_no) = ?', [count($amusements)]); // 모든 즐길거리 옵션을 포함하는지 확인합니다.
        }
        
        // 가격대 필터링
        if ($request->has('priceMin') && $request->has('priceMax')) {
            $priceMin = $request->priceMin;
            $priceMax = $request->priceMax;

            $campList->whereBetween('camps.price', [$priceMin, $priceMax]);
        }

        
        $result = $campList->paginate(5);

        log::debug('****************************');
        // log::debug('result', $result->toArray());
        // log::debug('****************************');
        
        $responseData = [
            'code' => '0'
            ,'msg' => ''
            ,'data' => $result->toArray()
        ];

        log::debug('responseData', $responseData);
    
        return response()->json($responseData, 200);
    }

    // // 검색 결과 획득
    // public function searchResult(Request $request) {
    //     $state = $request->state;
    //     $county = $request->county;

    //     $campList = Camp::select('camps.*')
    //                     ->orderBy('camps.state')
    //                     ;
    //                     // ->limit(20);
        
    //     if ($request->has('state') || filled($request->state)) {
    //         $campList->where('camps.state', $request->state);
    //     }
    //     if ($request->has('county') || filled($request->county)) {
    //         $campList->where('camps.county', $request->county);
    //     }
                        
    //     $result = $campList->paginate(5);

    //     $responseData = [
    //         'code' => '0'
    //         ,'msg' => ''
    //         ,'data' => $result->toArray()
    //     ];

    //     log::debug('****************************');
    //     log::debug('responseData', $responseData);
    
    //     return response()->json($responseData, 200);
    // }

    //   카운트 획득
    public function searchResultCount(Request $request) {
        $state = $request->state;
        $county = $request->county;

        $campList = Camp::select('camps.*')
                        ->orderBy('camps.state')
                        ;
                        // ->limit(20);
        
        if ($request->has('state') || filled($request->state)) {
            $campList->where('camps.state', $request->state);
        }
        if ($request->has('county') || filled($request->county)) {
            $campList->where('camps.county', $request->county);
        }
                        
        $result = $campList->get();

        $responseData = [
            'code' => '0'
            ,'msg' => ''
            ,'data' => $result->toArray()
        ];

        log::debug('****************************');
        log::debug('responseData', $responseData);
    
        return response()->json($responseData, 200);
    }
    
    // 메인에서 검색 결과 획득
    // public function mainResult(Request $request) {
    //     $state = $request->state;
    //     $county = $request->county;

    //     $campList = Camp::select('camps.*')
    //                     ->orderBy('camps.state')
    //                     ->limit(5);
        
    //     if ($request->has('state') || filled($request->state)) {
    //         $campList->where('camps.state', $request->state);
    //     }
    //     if ($request->has('county') || filled($request->county)) {
    //         $campList->where('camps.county', $request->county);
    //     }
                        
    //     $result = $campList->get();

    //     $responseData = [
    //         'code' => '0'
    //         ,'msg' => ''
    //         ,'data' => $result->toArray()
    //     ];
    
    //     return response()->json($responseData, 200);
    // }

    public function suggestCampingzang(Request $request)

    {
        // try {
        //     // 가장 최근의 캠핑장 데이터를 가져옵니다.
        //     $recentCamp = Camp::select('name', 'main_img')
        //                         ->orderBy('created_at', 'DESC')
        //                         ->first();

        //     if (!$recentCamp) {
        //         return response()->json([
        //             'code' => '1',
        //             'msg' => '캠핑 정보가 없습니다.',
        //             'data' => null
        //         ], 404);
        //     }


            try {
                // 가장 최근의 네 개의 캠핑장 데이터를 가져옵니다.
                $recentCamps = Camp::select('name', 'main_img')
                                ->orderBy('created_at', 'DESC')
                                ->take(4) // 네 개의 데이터를 가져옴
                                ->get();


                if ($recentCamps->isEmpty()) {
                    return response()->json([
                        'code' => '1',
                        'msg' => '캠핑 정보가 없습니다.',
                        'data' => null
                    ], 404);
                }

                return response()->json([
                    'code' => '0',
                    'msg' => '최근 캠핑 정보 획득 완료',
                    'data' => $recentCamps->toArray()
                ], 200);
            } catch (\Exception $e) {
                // 로그에 에러를 기록합니다.
                Log::error('Error in suggestCampingzang: ' . $e->getMessage());
                return response()->json([
                    'code' => '2',
                    'msg' => '서버 오류가 발생했습니다.',
                    'error' => $e->getMessage()
                ], 500);
            }

}

    // public function campDetailGet($id){ // TODO : 미완성
    //     // 캠핑장 데이터 획득
    //     // $sql = Camp::select('*')->whereNull('deleted_at')->get();
    //     $sql = Camp::find($id);

    //     $responseData = [
    //         'code' => '0'
    //         ,'msg' => ''
    //         ,'data' => $sql->toArray()
    //     ];
    //     Log::debug('camp/id', $sql->toArray());

    //     return response()->json($responseData, 200);
    // }

    public function campDetailGet($id) {

        $responseData = [
            'code' => '0'
            ,'msg' => ''
            ,'data' => $this->getCampDetail($id)
        ];
        Log::debug('상세', $responseData);
        return response()->json($responseData, 200);
    }

    // test
    private function getCampDetail($id) {
        $campInfo = Camp::find($id);
        $amenityInfo = Amenity::join('camp_amenities', 'camp_amenities.amenity_no', '=', 'amenities.id')
                                ->where('camp_amenities.camp_id','=',$id)->get();
        $amusementInfo = Amusement::join('camp_amusements', 'camp_amusements.amusement_no', '=', 'amusements.id')
                                ->where('camp_amusements.camp_id','=',$id)->get();
        $siteTypeInfo = SiteType::join('camp_site_types', 'camp_site_types.site_type_no', '=', 'site_types.id')
                                ->where('camp_site_types.camp_id','=',$id)->get();
        $topoInfo = Topo::join('camp_topos', 'camp_topos.topo_no','=','topos.id')
                        ->where('camp_topos.camp_id','=',$id)->get();
        return [
            'campInfo' => $campInfo
            ,'amenityInfo' => $amenityInfo
            ,'amusementInfo' => $amusementInfo
            ,'siteTypeInfo' => $siteTypeInfo
            ,'topoInfo' => $topoInfo
        ];
    }

    public function gpsTargetStamp(){
        $campInfo = Camp::all();
        $responseData = [
            'code' => '0'
            ,'msg' => ''
            ,'data' => $campInfo
        ];
        return response()->json($responseData, 200);
    }

    public function stampCnt(){
        $stampInfo = Stamp::select(DB::raw('count(*) as cnt'))->where('user_id', Auth::id())->get();

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $stampInfo
        ];

        return response()->json($responseData, 200);
    }

    public function allImgGet($id){
        $campId = Camp::find($id)->id;

        $imgInfo = Camp::select('other_img_1','other_img_2','other_img_3','other_img_4','other_img_5','other_img_6','other_img_7','other_img_8','other_img_9','other_img_10')
                        ->where('id',$campId)->get();

        $responseData = [
            'code' => '0',
            'msg' => '',
            'data' => $imgInfo
        ];

        return response()->json($responseData, 200);
    }




    public function updateCamp(Request $request)
{
    $id = $request->input('id');

    $camp = Camp::find($id);
    if (!$camp) {
        return response()->json(['message' => '해당 캠핑장을 찾을 수 없습니다.'], 404);
    }

    // 업데이트할 필드들을 받아옵니다.
    $camp->name = $request->input('name');
    $camp->address = $request->input('address');
    $camp->link = $request->input('link');
    $camp->price = $request->input('price');
    $camp->tel = $request->input('tel');

    // deleted_at 필드 처리
    $deletedAt = $request->input('deleted_at');
    if ($deletedAt === 'null') {
        $camp->deleted_at = null;
    } else {
        $camp->deleted_at = $deletedAt ? Carbon::parse($deletedAt) : null;
    }

    // 이미지 업데이트 처리
    if ($request->hasFile('main_img')) {
        // 기존 이미지 삭제
        if ($camp->main_img) {
            Storage::disk('public')->delete($camp->main_img); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->main_img = $request->file('main_img')->store('public/camp_images');
    }
    if ($request->hasFile('other_img_2')) {
        // 기존 이미지 삭제
        if ($camp->other_img_2) {
            Storage::disk('public')->delete($camp->other_img_2); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->other_img_2 = $request->file('other_img_2')->store('public/camp_images');
    }
    if ($request->hasFile('other_img_3')) {
        // 기존 이미지 삭제
        if ($camp->other_img_3) {
            Storage::disk('public')->delete($camp->other_img_3); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->other_img_3 = $request->file('other_img_3')->store('public/camp_images');
    }
    if ($request->hasFile('other_img_4')) {
        // 기존 이미지 삭제
        if ($camp->other_img_4) {
            Storage::disk('public')->delete($camp->other_img_4); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->other_img_4 = $request->file('other_img_4')->store('public/camp_images');
    }
    if ($request->hasFile('other_img_5')) {
        // 기존 이미지 삭제
        if ($camp->other_img_5) {
            Storage::disk('public')->delete($camp->other_img_5); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->other_img_5 = $request->file('other_img_5')->store('public/camp_images');
    }
    if ($request->hasFile('other_img_6')) {
        // 기존 이미지 삭제
        if ($camp->other_img_6) {
            Storage::disk('public')->delete($camp->other_img_6); // Storage에서 이미지 삭제
        }
        // 새로운 이미지 저장
        $camp->other_img_6 = $request->file('other_img_6')->store('public/camp_images');
    }

    $camp->save();

    return response()->json(['message' => '캠핑장 정보를 업데이트했습니다.', 'data' => $camp], 200);
}

    

}
