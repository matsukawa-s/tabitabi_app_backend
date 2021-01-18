<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Plan;
use App\PlanTag;

class PlanController extends Controller
{
    /**
     * IDで指定した予定を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getPlanData($id){
        $plan = Plan::where('id',$id)->first();

        $data = [];
        //var_dump($user);

        $userId = Auth::id();
        $userFlag = 0;
        if($userId == $plan->user_id){
            $userFlag = 1;
        }

        $tags = [];
        $tagId = [];
        $tagData = $plan->tag;
        $tagData2 = $plan->plantag;
        foreach($tagData as $tag){
            $tags [] = $tag["tag_name"];
        }
        foreach($tagData2 as $tag){
            $tagId [] = $tag["id"];
        }
        
        $data [] = [
            'id' => $plan->id,
            'plan_code' => $plan->plan_code,
            'title' => $plan->title,
            'description' => $plan->description,
            'start_day' => $plan->start_day,
            'end_day' => $plan->end_day,
            'image_url' => $plan->image_url,
            'cost' => $plan->cost,
            'is_open' => $plan->is_open,
            'favorite_count' => $plan->favorite_count,
            'number_of_views' => $plan->numver_of_views,
            'referenced_number' => $plan->referenced_number,
            'user_id' => $plan->user_id,
            'user_name' => $plan->user->name,
            'user_icon_path' => $plan->user->icon_path,
            'user_flag' => $userFlag,
            'tags' => $tags,
            'tag_id' => $tagId,
        ];

        return response()->json($data);
    }

    /**
     * ユーザIDが一致する予定を表示する
     * 
     * @param id user_id
     * @return json
     */


    /**
     * 予定登録
     *
     *@param request 
     *@return json
     */
    public function addPlanData(Request $request){
        $input = $request->all();
        //$input = json_decode($request['data']);
        //あとでuser_idとってくる
        $user_id = Auth::id();

        $plan = Plan::create([
          'plan_code' => uniqid("tb-"), 
          'title' => $input['title'],
          'start_day' => $input['start_day'],
          'end_day' => $input['end_day'],
          'image_url' => isset($path) ? basename($path) : $input['image_url'],
          'cost' => 0,
          'is_open' => $input['is_open'],
          'user_id' => $user_id,
        ]);

        $id = $plan->id;

        //タグを登録
        for($i=0; $i<count($input['tag_id']); $i++){
            $plantag = PlanTag::create([
                'tag_id' => $input['tag_id'][$i],
                'plan_id' => $id
            ]);
        }

        return $id;
    }

    /**
     * 日付の更新
     */
    public function updatePlanDateTime(Request $request){
        $input = $request->all();
        $plan = Plan::find($request['id']);
        $plan->start_day = $request['start_day'];
        $plan->end_day = $request['end_day'];
        $plan->save();

        return $plan;
    }

    /**
     * 公開設定の更新
     */
    public function updateOpenPlan(Request $request){
        $plan = Plan::find($request['id']);
        $plan->is_open = $request['is_open'];
        $plan->save();

        return $plan;
    }

    /**
     * プランの更新
     */
    public function updatePlan(Request $request){
        //タグが更新されているとき
        if($request["tag_flg"] == 1){
            //一旦タグ削除  
            $deletetag = new PlanTag;
            $deletetag->where('plan_id', $request['id'])->delete();

            //タグを登録
            for($i=0; $i<count($request['tag_id']); $i++){
                $plantag = PlanTag::create([
                    'tag_id' => $request['tag_id'][$i],
                    'plan_id' => $request['id']
                ]); 
            }
        }

        //プランの更新
        $plan = Plan::find($request["id"]);
        $plan->title = $request['plan_title'];
        $plan->image_url = $request['image_url'];
        $plan->save();

        return $plan;
    }

    public function getFavoritePlans(){
        return Auth::user()->plans()->get();
    }

    /**
     * プランの削除
     * @param id plan_id
     * @return json
     */
    public function deletePlan($id){
        $plan = Plan::find($id);
        $plan->delete();

        return $plan;
    }



}