<?php

namespace App\Http\Controllers;

use Illuminate\Http\requestuest;
use Illuminate\Http\Request;
use App\Plan;
use App\PlanUser;
use App\Tag;
use App\PlanTag;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * プランを全て取得する
     * @return json
     */
    public function index(Request $request){
        $user_id = Auth::id();
        $plan_query = Plan::OpenPlan()->where("user_id","!=",$user_id);
        $input = $request->all();
    
        // $user_id = 1;

        // 並び替えのリクエストがあるとき
        if(!empty($input['column'])){
            $plan_query->orderBy($input['column'],$input['order'])->get();
        }

        $plans = $plan_query->get();

        // islike の列を追加
        foreach ($plans as $key => $plan) {
            $flag = PlanUser::where('user_id',$user_id)
                    ->where('plan_id', $plan['id'])
                    ->first();
            $plan['islike'] = $flag == null ? false :true;
            $plan['user'] = $plan->user;
            $plan['tags'] = $plan->tag;
        }
        
        // return response()->json($plans);
        return $plans;
    }

    public function search(Request $request, $keyword)
    {
        $user_id = Auth::id();

        $plan_query = Plan::OpenPlan()->where("user_id","!=",$user_id);
        $input = $request->all();

        // 検索キーワードで絞り込み
        $plan_query->where('title', 'LIKE', "%{$keyword}%")->get();


        // 並び替えのリクエストがあるとき
        if (!empty($input['column'])) {
            $plan_query->orderBy($input['column'], $input['order'])->get();
        }

        $plans = $plan_query->get();

        // islike の列を追加
        foreach ($plans as $key => $plan) {
            $flag = PlanUser::where('user_id',$user_id)
                    ->where('plan_id', $plan['id'])
                    ->first();
            $plan['islike'] = $flag == null ? false :true;
        }

        return response()->json($plans);
    }

    public function tagSearch(Request $request, $keyword){
        $user_id = Auth::id();
        $plan_query = Plan::OpenPlan()->where("user_id","!=",$user_id);
        $input = $request->all();

        // 検索キーワードのタグがあるか
        $tag = Tag::where('tag_name', 'like', "{$keyword}");
        if($tag->exists()){
            $tag_id = $tag->first()->id;
            $plan_keys = PlanTag::select(['plan_id'])
                ->where('tag_id', $tag_id)
                ->get();
            $plans = Plan::whereIn('id',$plan_keys);
            // $plan_query = Plan::whereIn('id',$plan_keys)->query();
        }

        // 並び替えのリクエストがあるとき
        if (!empty($input['column'])) {
            $plans->orderBy($input['column'], $input['order'])->get();
        }

        $plans = $plans->get();

        // islike の列を追加
        foreach ($plans as $key => $plan) {
            $flag = PlanUser::where('user_id',$user_id)
                    ->where('plan_id', $plan['id'])
                    ->first();
            $plan['islike'] = $flag == null ? false :true;
        }

        // return $keyword;
        return response()->json($plans);
    }
    public function indexTag()
    {
        $tags = PlanTag::with('tag')
                ->select('tag_id',DB::raw('count(*) as count'))
                // ->where()
                ->groupby('tag_id')
                ->orderBy(DB::raw('count'),'desc')
                ->get();
        
        return response()->json($tags);
    }
    public function searchTag($key)
    {
        $tags = PlanTag::with('tag')
                ->select('tag_id',DB::raw('count(*) as count'))
                ->join('tags','tags.id','=','plan_tag.tag_id')
                ->where('tag_name', 'like', "{$key}%")
                ->groupby('tag_id')
                ->orderBy(DB::raw('count'),'desc')
                ->get();
        
        return response()->json($tags);
    }

    // プランのお気に入り更新
    public function update(Request $request){
        $planId = $request->input('favorite_plan_id');
        $userId = Auth::id();
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

        $plans = Plan::get();

        return response()->json($plans);
    }
}
