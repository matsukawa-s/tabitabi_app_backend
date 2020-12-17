<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itinerary;
use App\ItinerarySpot;
use App\Spot;

class ItinerarySpotController extends Controller
{
    /**
     * PlanIDで指定した予定行程を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getItinerarySpotData(Request $request)
    {
        $ids = $request["ids"];
        $itiSpots = ItinerarySpot::whereIn('itinerary_id',$ids)->get();
        $spots = Spot::all();

        $data = [];
        foreach($itiSpots as $itiSpot){
            $data[] = [
                'id' => $itiSpot->id,
                'cost' => $itiSpot->cost,
                'itinerary_id' => $itiSpot->itinerary_id,
                'spot_id' => $itiSpot->spot_id,
                'spot_name' => $itiSpot->spot->spot_name,
                'latitube' => $itiSpot->spot->memory_latitube,
                'longitube' => $itiSpot->spot->memory_longitube,
                'image_url' => $itiSpot->spot->image_url,
                'address' => $itiSpot->spot->address,
            ];
        }

        return response()->json($data);
    }

}