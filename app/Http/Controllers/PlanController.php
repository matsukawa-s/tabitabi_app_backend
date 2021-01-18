<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Plan;
use App\PlanTag;
use App\Itinerary;
use App\ItinerarySpot;
use App\ItineraryTraffic;
use App\ItineraryNote;

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

    /**
     * プランのコピー
     * @param id plan_id
     */
    public function copyPlan($id){
        $user_id = Auth::id();

        //コピー元のプラン取得
        $plan = Plan::find($id);

        //コピー先プラン作成
        $newPlan = Plan::create([
            'plan_code' => uniqid("tb-"), 
            'title' => $plan->title,
            'start_day' => $plan->start_day,
            'end_day' => $plan->end_day,
            'image_url' => $plan->image_url,
            'cost' => $plan->cost,
            'is_open' => 0,
            'user_id' => $user_id,
          ]
        );

        $newPlanID = $newPlan->id;

        //タグをコピー
        //コピー元タグを取得
        $tags = PlanTag::where('plan_id', $id)->get();
        foreach($tags as $tag){
            $newTag = PlanTag::create([
                'tag_id' => $tag->tag_id,
                'plan_id' => $newPlanID,
            ]);
        }

        //コピー元の行程取得
        $itineraries = Itinerary::where('plan_id', $id)->get();
        //コピー先行程作成
        foreach($itineraries as $itinerary){
            $newIti = Itinerary::create([
                'itinerary_order' => $itinerary->itinerary_order,
                'spot_order' => $itinerary->spot_order,
                'day' => $itinerary->day,
                'plan_id' => $newPlanID,
            ]);

            //スポットor交通orメモを取得する
            $itiSpo = ItinerarySpot::where('itinerary_id', $itinerary->id)->first();
            if(!is_null($itiSpo)){
                $newItiSpo = ItinerarySpot::create([
                    'cost' => $itiSpo->cost,
                    'spot_id' => $itiSpo->spot_id,
                    'itinerary_id' => $newIti->id,
                    'start_date' => $itiSpo->start_date,
                    'end_date' => $itiSpo->end_date,
                ]);
            }

            $itiTra = ItineraryTraffic::where('itinerary_id', $itinerary->id)->first();
            if(!is_null($itiTra)){
                $newItiTra = ItineraryTraffic::create([
                   'traffic_class' => $itiTra->traffic_class, 
                   'travel_time' => $itiTra->travel_time,
                   'traffic_cost' => $itiTra->traffic_cost,
                   'itinerary_id' => $newIti->id,
                ]);
            }

            $itiNote = ItineraryNote::where('itinerary_id', $itinerary->id)->first();
            if(!is_null($itiNote)){
                $newItiNote = ItineraryNote::create([
                    'memo' => $itiNote->memo,
                    'itinerary_id' => $newIti->id,
                ]);
            }
        }
        
        return $newPlanID;
    }

}