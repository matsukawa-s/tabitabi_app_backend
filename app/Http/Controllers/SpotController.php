<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Spot; 
use App\SpotUser;
use App\Type;
use App\SpotType;
use App\Plan;
use App\Itinerary;
use App\ItinerarySpot;
use Validator;

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
        $spot_type = SpotType::whereIn('spot_id',$favorite_spots_keys)->orderby('spot_id')->get()->toArray();

        $tmp = array();
        foreach($spots as $spot){  
            // $keys = array_keys($spot_type,$value->id);
            foreach($spot_type as $value){
                if($value["spot_id"] === $spot->id){
                    array_push($tmp,$value["type_id"]);
                }
            }
            $spot["types"] = $tmp;
            $tmp = [];
        }

        // return $spot_type;
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
        $plans = [];

        // スポットテーブルに存在するかチェックする
        // 存在すれば、
        if(Spot::where('place_id',$id)->exists()){
            //プレイスIDからスポットIDを取得する
            $spot_id = Spot::where('place_id',$id)->first()->id;
            if(SpotUser::where('user_id',$user->id)->where('spot_id',$spot_id)->exists()){
                $is_favorite = true;
            }

            // 対象のスポットが入っているプランを取得する
            $itinerary_ids = ItinerarySpot::select(['itinerary_id'])->where('spot_id',$spot_id)->get();
            // return $itinerary_ids;
            $plan_ids = Itinerary::select(['plan_id'])->whereIn('id',$itinerary_ids)->get();
            // return $plan_ids;
            $plans = Plan::OpenPlan()->whereIn('id',$plan_ids)->get();
        }

        return response()->json([
            'spot_id' => $spot_id,
            'isFavorite' => $is_favorite,
            'plan_containing_spots' => $plans
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
                $types = Type::whereIn('english_name',$input["types"])->get();

                foreach($types as $type){
                    SpotType::create([
                        "type_id" => $type->id,
                        "spot_id" => $spot->id
                    ]);
                }

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

    
    // public function getPlanContainingSpot(Request $request){
        // ItinerarySpot
    // }

    /**
     * 場所タイプの情報を取得する
     */
    public function getSpotTypes(){
        $types = Type::all();
        // $types = Spot::with('types')->get();
        return $types;
    }

    /**
     * IDで指定したスポットを表示する
     * 
     * @param id spot_id
     * @return json
     */
    public function getSpotGet($id){
        $data = Spot::where('id',$id)->get();

        return $data;
    }

    /**
     * スポット登録されてなかった登録する
     * 
     * @param request
     * @return json
     */
    public function addIfSpot(Request $request){
        $input = $request->all();

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
                $types = Type::whereIn('english_name',$input["types"])->get();

                foreach($types as $type){
                    SpotType::create([
                        "type_id" => $type->id,
                        "spot_id" => $spot->id
                    ]);
                }

                // スポットIDを登録したIDに更新
                return $spot->id;
            });
        }else{
            $spot_id = $input['spot_id'];
        }

        return $spot_id;
    }

    /**
     * スポット登録
     *
     *@param request 
     *@return json
     */
    public function addSpotData(Request $request){
        $input = $request->all();

        $plan = Spot::create([
           'place_id' => $input['place_id'],
           'spot_name' => $input['spot_name'],
           //'place_types' => $input['place_types'],
           'memory_latitube' => $input['latitube'],
           'memory_longitube' => $input['longitube'],
           'image_url' => $input['image_url'],
           'prefecture_id' => $input['prefecture_id'],
           //'address' => $input['address'],
        ]);

        $id = $plan->id;
        return $id;
      }
}