<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\OpenPhoto;
use App\Plan;

class ReviewController extends Controller
{
    /**
     * 選択したプランのレビュー取得
     * 
     * @param $id プランID
     */
    public function getReview($id){
        $review = Review::where("plan_id",$id)->first();
        
        $data = [];
        if(!$review == ""){

            $openPhoto = [];
            foreach($review->openPhoto as $photo){
                $openPhoto [] = $photo['photo_url'];
            }

            $data [] = [
                'id' => $review->id,
                'r_contents' => $review->r_contents,
                'photo_url' => $openPhoto
            ];
        }

        return response()->json($data);
    }

    /**
     * レビューを追加する
     */
    public function addReview(Request $request){
        $user_id = Auth::id();

        //レビュー保存
        $review = Review::create([
            'user_id' => $user_id,
            'plan_id' => $request['plan_id'],
            'r_contents' => $request['r_contents'],
        ]);

        //画像URLを保存
        foreach($request['image_urls'] as $imageUrl){
            $openPhoto = OpenPhoto::create([
                'review_id' => $review->id,
                'photo_url' => $imageUrl
            ]);
        }

        //コストを更新
        $plan = Plan::find($request['plan_id']);
        $plan->cost = $request['cost'];
        $plan->save();

        return $review;
    }
}