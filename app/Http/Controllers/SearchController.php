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
    public function index(Request $request){
        $plan_query = Plan::query();
        $input = $request->all();

        // 並び替えのリクエストがあるとき
        if(!empty($input['column'])){
            $plan_query->orderBy($input['column'],$input['order'])->get();
        }

        $plans = $plan_query->get();
        
        return response()->json($plans);
    }

    public function search(Request $request, $id)
    {
        $plan_query = Plan::query();
        $input = $request->all();

        // 検索キーワードで絞り込み
        $plan_query->where('title', 'LIKE', "%{$id}%")->get();


        // 並び替えのリクエストがあるとき
        if (!empty($input['column'])) {
            $plan_query->orderBy($input['column'], $input['order'])->get();
        }

        $plans = $plan_query->get();

        return response()->json($plans);
    }

    // プランのお気に入り更新
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
