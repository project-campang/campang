<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityType;
use Illuminate\Support\Facades\Log;

class CommunityTypeController extends Controller
{
    public function index()
    {
        try {
            $communityTypes = CommunityType::all();
            return response()->json($communityTypes);
        } catch (\Exception $e) {
            Log::error('Error fetching community types: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch community types'], 500);
        }
    }
}

