<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Plan;
use App\Spot;

class TopController extends Controller
{
    public function index(){
        // 本日のプラン取得
        // 人気のプラン取得
        $popular_plans = Plan::select(DB::raw("*, favorite_count + number_of_views + referenced_number as score"))
                            ->orderby(DB::raw("score"),'desc')
                            ->limit(10)
                            ->get();

        // 人気のスポット取得
        // 最近見たプラン取得

        return response()->json([
            "today_plans" => [],
            "popular_plans" => $popular_plans,
            "popular_spots" => [],
            "plan_history" => [],
        ]);
    }
}
