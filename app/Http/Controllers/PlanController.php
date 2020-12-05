<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Plan;

class PlanController extends Controller
{
    /**
     * IDで指定した予定を表示する
     * 
     * @param id plan_id
     * @return json
     */
    public function getPlanData($id){
        $data = Plan::where('id',$id)->get();

        return $data;
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
        //あとでuser_idとってくる
        $user_id = 1;

        $plan = Plan::create([
          'title' => $input['title'],
          'description' => $input['description'],
          'start_day' => $input['start_day'],
          'end_day' => $input['end_day'],
          'image_url' => $input['image_url'],
          'cost' => 0,
          'is_open' => $input['is_open'],
          'user_id' => $user_id,
        ]);

        $id = $plan->id;
        return $id;
    }

}