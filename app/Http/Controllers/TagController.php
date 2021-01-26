<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Tag;

class TagController extends Controller
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
     * タグを全部取得する
     * 
    */
    public function getTag(){
        $tags = Tag::all();

        return response()->json($tags);
    }

    /**
     * タグを検索する
     * @param request name //タグの名前
    */
    public function searchTag($name){
        $tag = Tag::where('tag_name', $name)->get();
        return $tag;
    }

    /**
     * タグを追加する
     * 
     * @param tag_name 追加するタグの名前
     */
    public function addTag(Request $request){
        $input = $request->all();

        $data = Tag::where('tag_name', $input['tag_name'])->first();

        if((string)$data === "[]"){
            $newtag = Tag::create([
                'tag_name' => $input['tag_name'],
            ]);

            $data = $newtag;
        }
        return response()->json($data);
    }

}