<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Plan;
use App\Spot;
use App\Prefectures;
use App\SpotUser;
use App\ItinerarySpot;

class TopController extends Controller
{
    public function index(){
        // 今日のプラン取得
        $today = date("Y-m-d");

        $today_plans = Plan::where('user_id',Auth::id())
            ->whereDate('start_day','<=',$today)
            ->whereDate('end_day','>=',$today)
            ->get();

        // return $today_plans;

        // 人気のプラン取得
        $popular_plans = Plan::select(DB::raw("*, favorite_count + number_of_views + referenced_number as score"))
                            ->orderby(DB::raw("score"),'desc')
                            ->limit(10)
                            ->get();

        // 人気のスポット取得
        $popular_spots_keys = ItinerarySpot::select('spot_id')
            ->groupBy('spot_id')
            ->orderby(DB::raw('count(*)'),'desc')
            ->limit(10)
            ->get();

        $tmp = array();
        foreach($popular_spots_keys as $value){
            array_push($tmp,$value->spot_id);
        }

        $popular_spots_order = implode(',',$tmp);

        $popular_spots = Spot::whereIn('id', $popular_spots_keys)
            ->orderByRaw(DB::raw("FIELD(id, $popular_spots_order)"))
            ->get();

        // スポットのお気に入り情報を取得
        $spot_user = SpotUser::where('user_id',Auth::id())->get();

        foreach($popular_spots as $value){
            foreach($spot_user as $value2){
                if($value->id == $value2->spot_id){
                    $value['isLike'] = true;
                    break;
                }else{
                    $value['isLike'] = false;
                }
            }
        }

        // 都道府県ごとのスポットを取得
        $prefectures_spots = Prefectures::with('spots')
            ->whereIn('id',[1,13,26,27,47])->get();

        return response()->json([
            "today_plans" => $today_plans,
            "popular_plans" => $popular_plans,
            "popular_spots" => $popular_spots,
            "prefectures_spots" => $prefectures_spots,
        ]);
    }
}
