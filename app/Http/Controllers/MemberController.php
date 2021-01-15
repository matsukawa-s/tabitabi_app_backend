<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
use App\Plan;

class MemberController extends Controller
{
    /**
     * 参加するプランを探す
     */
    public function searchJoinPlan($code){
        $plan = Plan::with('user')->where('plan_code',$code)->first();
        $is_exist = false;
        $message = '';

        if(isset($plan)){
            $is_exist = true;
        }else{
            $is_exist = false;
            $message = 'プランが見つかりませんでした';
        }

        return response()->json([
            'is_exist' => $is_exist,
            'plan' => $plan,
            'message' => $message,
        ]);
    }

    /**
     * プランに参加する
     */
    public function joinPlan(Request $request){
        $input = $request->all();

        $plan = Plan::where('plan_code',$input["plan_code"])->first();

        // プランが存在するか確認する
        if(!isset($plan)){
            return response()->json([
                'message' => 'プランが見つかりませんでした'
            ]);
        }

        // 自分のプランかどうか確認する
        if($plan->user_id == Auth::id()){
            return response()->json([
                'message' => '自分の作成したプランです'
            ]);
        }

        // プランに参加済みかどうか確認する
        $menber = Member::where('plan_id',$plan->id)->where('user_id',Auth::id());
        if($menber->exists()){
            return response()->json([
                'message' => 'すでにプランに参加しています'
            ]);
        }

        // メンバーに追加する
        $menber = Member::create([
            'plan_id' => $plan->id,
            'user_id' => Auth::id()
        ]);

        return response()->json([
            'message' => 'プランに参加しました',
        ]);
    }

    /**
     * プランから抜ける
     */
    public function getOutOfPlan(Request $request){
        return response()->json([
            'success' => true,
        ]);
    }
}
