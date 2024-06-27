<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityType;
use Illuminate\Support\Facades\Log;

class CommunityTypeController extends Controller
{
    public function index($id)
    {
        try {
            $communityTypes = CommunityType::find($id)->id;
            

            $responseData = [
                'code' => '0'
                ,'msg' => ''
                ,'data' => $communityTypes
            ];

    
            // 리턴
            return response()->json($responseData, 200);

        } catch (\Exception $e) {
            Log::error('111Error fetching community types: ' . $e->getMessage());
            return response()->json(['error' => '333Failed to fetch community types'], 500);
        }

        
    }
}

