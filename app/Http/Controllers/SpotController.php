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
            $spot_user = SpotUser::where('user_id',$user->id)->where('spot_id',$spot_id)->fisrt();
            $is_favorite = true;
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
        // スポットが登録されいなければ登録する
        if($input["spot_id"] == null){
            
        }
    }

    /**
     * スポットがすでにテーブルに存在するかチェックする
     */
    function checkExistSpots(){

    }
}
