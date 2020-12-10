<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Spot;

class SpotController extends Controller
{
    /**
     * IDで指定したスポットを表示する
     * 
     * @param id spot_id
     * @return json
     */
    public function getSpotGet($id){
        $data = Spot::where('id',$id)->get();

        return $data;
    }

    /**
     * スポット登録
     *
     *@param request 
     *@return json
     */
    public function addSpotData(Request $request){
        $input = $request->all();

        $plan = Spot::create([
           'place_id' => $input['place_id'],
           'spot_name' => $input['spot_name'],
           'place_types' => $input['place_types'],
           'memory_latitube' => $input['latitube'],
           'memory_longitube' => $input['longitube'],
           'image_url' => $input['longitube'],
           'address' => $input['address'],
        ]);

        $id = $plan->id;
        return $id;
      }

}