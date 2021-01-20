<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Photo;

class PhotoController extends Controller
{
    /**
     * 指定したplan_idの写真をとってくる
     * 
     * @param id plan_id
     * @return json
     */
    public function getPhotos($id){
        $photos = Photo::where('plan_id',$id)->get();
        return response()->json($photos);
    }

    /**
     * 写真をまとめて登録
     * 
     */
    public function addPhotos(Request $request){
        $urls = $request['urls'];
        
        foreach($urls as $url){
            $photo = Photo::create([
                'photo_url' => $url,
                'plan_id' => $request['plan_id'],
            ]);
        }
        return $photo;
    }
    
    /**
     * 選択した画像を削除
     * 
     * @param id photo_id
     * @return json
     */
    public function deletePhoto($id){
        $photo = Photo::find($id);
        $photo->delete();
        return $photo;
    }
}