<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itinerary;
use App\ItineraryTraffic;

class ItineraryTrafficController extends Controller
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
        $data = [];
        $data = ItineraryTraffic::whereIn('itinerary_id',$ids)->get();

        return response()->json($data);
    }

    /**
     * 時間の更新
     */
    public function updateTime(Request $request){
        $id = $request["id"];

        $updateItiTraffic= new \stdClass;
        $updateItiTraffic = ItineraryTraffic::find($id);
        $updateItiTraffic->travel_time = $request["travel_time"];
        $updateItiTraffic->save();

        return $updateItiTraffic;
    }

}