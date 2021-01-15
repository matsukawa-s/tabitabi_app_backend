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
          'spot_order' => $input['spot_order'],
          'plan_id' => $input['plan_id'],
        ]);

        $itidata = [];
        $itidata = Itinerary::where('plan_id', $input['plan_id'])->get();
        
        $id = $iti->id;
        $ids[] = (string)$iti->id;
        
        switch($input['type']){
            //スポット追加
            case 0:
                $itiSpot = ItinerarySpot::create([
                    'cost' => 0,
                    'itinerary_id' => $id,
                    'spot_id' => $input['spot_id'],
                ]);
                $ids[] = (string)$itiSpot->id;
                break;
            //交通追加    
            case 1:
                $itiTraffic = ItineraryTraffic::create([
                    'traffic_class' => $input['traffic_class'],
                    'travel_time' => $input['travel_time'],
                    'traffic_cost' => $input['traffic_cost'],
                    'itinerary_id' => $id,
                ]);
                $ids[] = (string)$itiTraffic->id;
                break;
            case 2:
                $itiNote = ItineraryNote::create([
                    'memo' => $input['memo'],
                    'itinerary_id' => $id,
                ]);
                $ids[] = (string)$itiNote->id;
                break;
        }

        foreach ($itidata as $value) {
            if($input['order'] <= $value["itinerary_order"] && strcmp($input['day'], $value["day"]) == 0 && $id != $value["id"]){
                $order = $value["itinerary_order"] + 1;
                $updateIti = Itinerary::find($value["id"]);
                $updateIti->itinerary_order = $order;
                if($input['type'] == 0){
                  $updateIti->spot_order = $value["spot_order"] + 1;
                }
                $updateIti->save();
                //var_dump("laravel id : " . (string)$value["id"] . " : " . (string)$order);
                //var_dump($value["itinerary_order"] + 1);
                //var_dump($updateIti);
            }
        }

        return $ids;
    }

    /**
     * 行程を並び替える
    */
    public function rearrangeItineraryData($itiId, $order, $spotOrder, $dataType){
        
        //移動するitineraryData
        $data = Itinerary::find($itiId);
        
        $itiDatas = Itinerary::where('plan_id', $data["plan_id"])->where('day', "=" , $data["day"])->get();
        //並び替え
        foreach ($itiDatas as $itiData) {
            if($data["itinerary_order"] > $order){
                //下から上
                if($itiData["itinerary_order"] >= $order && $itiData["itinerary_order"] < $data["itinerary_order"]){
                    $updateIti = Itinerary::find($itiData["id"]);
                    $updateIti->itinerary_order = $updateIti["itinerary_order"] + 1;
                    if($dataType == 0){
                         $updateIti->spot_order = $updateIti["spot_order"] + 1;
                    }
                    $updateIti->save();
                }
            }else{  
                //上から下
                if($itiData["itinerary_order"] <= $order && $itiData["itinerary_order"] > $data["itinerary_order"]){
                    $updateIti = Itinerary::find($itiData["id"]);
                    $updateIti->itinerary_order = $updateIti["itinerary_order"] - 1;
                    if($dataType == 0){
                        $updateIti->spot_order = $updateIti["spot_order"] - 1;
                    }
                    $updateIti->save();
                }
            }
        }

        $updateIti = Itinerary::find($itiId);
        $updateIti->itinerary_order = $order;
        $updateIti->spot_order = $spotOrder;

        $updateIti->save();

        return response()->json($itiDatas);
    }

    /**
     * 行程を削除する
     */
    public function deleteItineraryData($itiId, $dataType){
        $deleteIti = Itinerary::find($itiId);

        //itineraryの順番の変更
        $itiDatas = [];
        $itiDatas = Itinerary::where('plan_id', $deleteIti["plan_id"])->where('day', "=" , $deleteIti["day"])->get();
        foreach($itiDatas as $itiData){
            if($itiData['itinerary_order'] > $deleteIti['itinerary_order']){
                $updateIti = Itinerary::find($itiData["id"]);
                $updateIti->itinerary_order = $updateIti["itinerary_order"] - 1;
                if($dataType == 0){
                  $updateIti->spot_order = $updateIti["spot_order"] - 1;
                }
                $updateIti->save();
            }
        }

        $deleteIti->delete();

        return $deleteIti;
    }


}