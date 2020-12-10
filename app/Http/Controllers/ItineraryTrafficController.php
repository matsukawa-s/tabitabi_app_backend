<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itinerary;
use App\ItineraryTraffic;

class ItineraryTraffcController extends Controller
{
    /**
     * PlanIDで指定した予定行程を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getItineraryTrafficData(Request $request)
    {
        $ids = $request["ids"];
        $data = ItineraryTraffic::whereIn('itinerary_id',$ids)->get();

        return response()->json($data);
    }

}