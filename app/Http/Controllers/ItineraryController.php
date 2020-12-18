<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itinerary;
use App\ItinerarySpot;
use App\ItineraryTraffic;
use App\ItineraryNote;


class ItineraryController extends Controller
{
    /**
     * PlanIDで指定した予定行程を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getItineraryData($id){
        $data = Itinerary::where('plan_id',$id)->get();
        return response()->json($data);
    }

    /**
     * 行程を追加する
     * また追加する際にスポット行程、交通行程、メモ行程にも追加する
     */
    public function addItineraryData(Request $request){
        $input = $request->all();
     
        $iti = Itinerary::create([
          'itinerary_order' => $input['order'],
          'day' => $input['day'],
          'plan_id' => $input['plan_id'],
        ]);

        $itidata = [];
        $itidata = Itinerary::where('plan_id', $input['plan_id'])->get();

        var_dump($itidata[0]["day"]);
        
        $id = $iti->id;
        
        switch($input['type']){
            //スポット追加
            case 0:
                $itiSpot = ItinerarySpot::create([
                    'cost' => 0,
                    'itinerary_id' => $id,
                    'spot_id' => $input['spot_id'],
                ]);

                //index以下のitineraryOrderの値を1ふやす
                for($i=0; $i<count($itidata); $i++){
                    if($input['order']+1 < $itidata[$i]["itinerary_order"] &&  strcmp($input['day'],$itidata[$i]["day"]) == 0){
                        $updateIti = Itinerary::find($itidata[$i]["id"]);
                        $updateIti->itinerary_order = $itidata[$i]["itinerary_order"] + 1;
                        $updateIti->save();
                        var_dump($updateIti);
                    }
                }
                break;
            case 1:
                $itiTraffic = ItineraryTraffic::create([
                    'traffic_class' => $input['tarric_class'],
                    'travel_time' => $input['travel_time'],
                    'traffic_cost' => $input['traffic_cost'],
                    'itinerary_id' => $id,
                ]);
                break;
            case 2:
                $itiNote = ItineraryNote::create([
                    'memo' => $input['memo'],
                    'itinerary_id' => $id,
                ]);
                break;
        }

        return $id;
    }

}