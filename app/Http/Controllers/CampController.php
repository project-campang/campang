<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Amusement;
use App\Models\Camp;
use App\Models\County;
use App\Models\SiteType;
use App\Models\Stamp;
use App\Models\State;
use App\Models\Topo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CampController extends Controller
{


    // 캠핑장 데이터 획득 + 페이지네이션
    public function campListGet(Request $request) {
        log::debug('campListGet', $request->all());

        
        $campList = Camp::select('camps.*')
                        ->join('states', 'camps.state', '=', 'states.name')
                        ->join('counties', 'camps.county', '=', 'counties.name')
                        // ->groupBy('camps.id' )
                        ->orderBy('camps.county');
                        // ->limit()
        
        if($request->has('state') && $request->state != '0') {
            $campList->where('states.id', $request->state);
        }
        if($request->has('county') && $request->county != '0') {
            $campList->where('counties.id', $request->county);
        }

        $result = $campList->paginate(5);
        
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
}
