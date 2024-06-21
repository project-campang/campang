<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Amusement;
use App\Models\Camp;
use App\Models\SiteType;
use App\Models\Topo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CampController extends Controller
{

    // 캠핑장 데이터 획득
    public function campListGet() {
        
        $campList = Camp::select('camps.*')
                        // ->join('camp_amenities', 'camps.id', '=', 'camp_amenities.camp_id')
                        // ->join('camp_amusements', 'camps.id', '=', 'camp_amusements.camp_id')
                        // ->join('camp_site_types', 'camps.id', '=', 'camp_site_types.camp_id')
                        // ->join('camp_topos', 'camps.id', '=', 'camp_topos.camp_id')
                        // ->groupBy('camps.id' )
                        ->orderBy('camps.name')
                        ->get();

    log::debug('게시글 정보', $campList->toArray());

    $responseData = [
        'code' => '0'
        ,'msg' => ''
        ,'data' => $campList->toArray()
    ];

        // log::debug('게시글 정보', $campList->toArray());

        
        log::debug('responseData', $responseData);
    // log::debug('responseData1', $responseData);

    return response()->json($responseData, 200);
    }



    // 검색 결과 획득
    public function searchResult(Request $request) {
        $state = $request->input('state');
        $county = $request->input('county');

        $result = Camp::select()
                        ->get();

    }





    public function suggestCampingzang(Request $request)
{
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
}
