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
        
        $data [] = [
            'id' => $plan->id,
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
     * 画像アップロード
     *  
    */ 
    public function uploadImage(Request $request){
        $path = "No!";
        var_dump('bbbb');

        if($request->hasFile('image')){
            var_dump('aaaaa');
            $path ="aa";
            $path = $this->upFile($request);
            if($path==false){
                return response()->json([
                    'status' => 400,
                    'error' => '画像ファイルではありません'
                ]);
            }
        }
        return $path;
    }

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

        // if($request->hasFile('image')){
        //     $path ="aa";
        //     $path = $this->upFile($request['image']);
        //     if($path==false){
        //         return response()->json([
        //             'status' => 400,
        //             'error' => '画像ファイルではありません'
        //         ]);
        //     }
        // }

        $plan = Plan::create([
          'plan_code' => uniqid("tb-"), 
          'title' => $input['title'],
          'description' => $input['description'],
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


    function upFile($request){
        // バリデーションルール
        $rules = [
            'image' => 'image'//jpeg, png, bmp, gif, svg
        ];

        var_dump('1');
        var_dump($request);
        // return $request->all();
        $validator = Validator::make($request->all(), $rules);

        var_dump('2');
        // バリデーションチェックを行う
        if ($validator->fails()) {
            return false;
        }
        var_dump('3');
        //画像の保存処理（storage/public/diary_images）
        $path = $request->file('image')->store('public/images');
    
        var_dump('4');

        return $path;
    }

}