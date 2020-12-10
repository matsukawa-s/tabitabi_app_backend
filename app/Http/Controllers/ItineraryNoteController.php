<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itinerary;
use App\ItineraryNote;

class ItineraryNoteController extends Controller
{
    /**
     * PlanIDで指定した予定行程を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getItineraryNoteData(Request $request)
    {
        $ids = $request["ids"];
        $data = ItineraryNote::whereIn('itinerary_id',$ids)->get();

        return response()->json($data);
    }

}