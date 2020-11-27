<?php

namespace App\Http\Controllers;

use Illuminate\Http\requestuest;
use Illuminate\Http\Request;
use App\Plan;
use App\PlanUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * プランを全て取得する
     * @return json
     */
    public function index(){
        // $plans = \App\Plan::orderby("timestamps",'asc')->get();
        $plans = Plan::get();

        return response()->json($plans);
        // return response()->json(['apple' => 'red', 'peach' => 'pink']);
    }

    public function search($id){
        if (!empty($id)) {
            $plans = Plan::where('title', 'LIKE', "%{$id}%")->get();
        }else{
            $plans = null;
        }

        return response()->json($plans);
    }

    public function update(Request $request){
        // $plans = Plan::where('id',1)->get();
        // return response()->json($request->all());
        $planId = $request->input('favorite_plan_id');
        $userId = $request->input('user_id');
        $favoritePlan = PlanUser::where('plan_id',$planId)->where('user_id',$userId)->first();
        $planUser = new PlanUser;

        if($favoritePlan == null){
            Plan::where('id',$planId)
            ->increment('favorite_count');

            $planUser->create(['plan_id' => $planId,'user_id' => $userId]);
        }else{
            Plan::where('id',$planId)
            ->decrement('favorite_count');

            $planUser->where('plan_id',$planId)->where('user_id',$userId)->delete();
        }

        // $plans = PlanUser::get();
        $plans = Plan::get();
        // $plans = Plan::where('id',$planId)->get();

        return response()->json($plans);
    }
}
