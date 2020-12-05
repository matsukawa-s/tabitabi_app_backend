<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Spot; 
use App\SpotUser;

class SpotController extends Controller
{
    /**
     * ユーザーのお気に入りスポットを全て取得する
     * 
     * @param request
     * @return json 
     */
    public function getAllFavorite(){
        $user = Auth::user();
        $favorite_spots_keys = SpotUser::select(['spot_id'])->where('user_id',$user->id)->get();
        $spots = Spot::whereIn('id',$favorite_spots_keys)->get();

        return $spots;
    }

    /**
     * ひとつのスポットがお気に入り登録されているかどうかを調べる
     * 
     * @param integer $id place_id
     * @return json
     */
    public function getOneFavorite($id){
        $user = Auth::user();
        $is_favorite = false;
        $spot_id = null;

        // スポットテーブルに存在するかチェックする
        // 存在すれば、
        if(Spot::where('place_id',$id)->exists()){
            //プレイスIDからスポットIDを取得する
            $spot_id = Spot::where('place_id',$id)->first()->id;
            if(SpotUser::where('user_id',$user->id)->where('spot_id',$spot_id)->exists()){
                $is_favorite = true;
            }
        }

        return response()->json([
            'spot_id' => $spot_id,
            'isFavorite' => $is_favorite,
        ]);
    }

    /**
     * スポットのお気に入り登録と解除をする
     * 
     * @param request
     * @return json
     */
    public function postFavoriteSpot(Request $request){
        $input = $request->all();
        $user = Auth::user();

        // スポットが登録されいなければ登録する
        if(is_null($input["spot_id"])){
            $spot_id = DB::transaction(function () use($input){
                // スポットを新規登録
                $spot = Spot::create([
                    'place_id' => $input['place_id'],
                    'spot_name' => $input['name'],
                    'memory_latitube' => $input['lat'],
                    'memory_longitube' => $input['lng'],
                    'image_url' => $input['photo'],
                    'prefecture_id' => $input['prefecture_id']
                ]);

                // スポットのタイプを新規登録
                // $spot_classification = 

                // スポットIDを登録したIDに更新
                return $spot->id;
            });
        }else{
            $spot_id = $input['spot_id'];
        }

        $sql = SpotUser::where('user_id',$user->id)->where('spot_id',$spot_id);

        //お気に入り登録しているとき
        if($sql->exists()){
            $sql->delete();
        }else{
            //登録する
            $spot_user = SpotUser::create([
                'spot_id' => $spot_id,
                'user_id' => $user->id
            ]);
        }

        return response()->json([
            'success' => true,
            'spot_id' => $spot_id,
        ],200);
    }
}
