<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Comment; 
use Validator;

class CommentController extends Controller
{

    /**
     * コメント取得
     * 
     * @param $id プランID
     */
    function getComment($id){
        $comments = Comment::where('plan_id',$id)->get();

        $data = [];
        foreach($comments as $comment){
            $data [] = [
                'id' => $comment->id,
                'c_contents' => $comment->c_contents,
                'user_id' => $comment->user->id,
                'name' => $comment->user->name,
                'icon_path' => $comment->user->icon_path,
                'email' => $comment->user->email,
            ];
        }
        return response()->json($data);
    }

    /**
     * コメント登録
     * 
     */
    function addComment(Request $request){
        $userId = Auth::id();
        $comment = Comment::create([
            'user_id' => $userId,
            'plan_id' => $request['plan_id'],
            'c_contents' => $request['c_contents'],
        ]);

        return $comment;
    }
}