<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Spot; 
use App\SpotUser;

class SpotController extends Controller
{
    /**
     * ユーザーのお気に入りしているスポットを取得する
     */
    public function getAllFavorite(){

    }

    /**
     * ひとつのスポットがお気に入り登録されているかどうかを調べる
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
     */
    public function postFavoriteSpot(Request $request){
        $input = $request->all();
        $user = Auth::user();

        // スポットが登録されいなければ登録する
        if(is_null($input["spot_id"])){
            $spot = Spot::create([
                'place_id' => $input['place_id'],
                'spot_name' => $input['name'],
                'memory_latitube' => $input['lat'],
                'memory_longitube' => $input['lng'],
                'image_url' => $input['photo'],
                'prefecture_id' => 1
            ]);
            $spot_id = $spot->id;
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

    /**
     * スポットがすでにテーブルに存在するかチェックする
     */
    function checkExistSpots(){

    }
}
