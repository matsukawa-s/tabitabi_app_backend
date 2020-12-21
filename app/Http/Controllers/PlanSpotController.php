<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\PlanSpot;
use App\Spot;

class PlanSpotController extends Controller
{
    /**
     * 指定したプランIDからスポットを取得
     */
    public function getPlanSpotData($id){
        $planSpots = PlanSpot::where('plan_id',$id)->get();

        $data = [];
        foreach($planSpots as $planSpot){
            $data [] = [
                'id' => $planSpot->id,
                'spot_id' => $planSpot->spot_id,
                'place_id' => $planSpot->spot->place_id,
                'spot_name' => $planSpot->spot->spot_name,
                'latitube' => $planSpot->spot->memory_latitube,
                'longitube' => $planSpot->spot->memory_longitube,
                'image_url' => $planSpot->spot->image_url,
                'prefecture_id' => $planSpot->spot->prefecture_id,
            ];
        }

        return response()->json($data);
    }

    /**
     * 指定したプランIDにスポットを登録
     */
    public function addPlanSpotData(Request $request){
        $input = $request->all();

        foreach ($input as $value) {
            $planSpot = PlanSpot::create([
                'plan_id' => $value['plan_id'],
                'spot_id' => $value['spot_id'],
            ]);
        }

        return $planSpot;
    }

    /**
     * 指定したスポットを削除
     */
    public function deletePlanSpotData($id){
        $planSpot = PlanSpot::find($id);
        $planSpot->delete();

        return $planSpot;
    }
  
}