<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Plan;
use App\PlanUser;
use App\Member;
use Auth;


class UserController extends Controller
{
    /**
     * ログイン
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
          ]);
        } else {
            //認証エラー(401)
            return response()->json([
                'success' => false,
                'message' => 'メールアドレスまたはパスワードが違います。',
            ], 401);
        }
    }

    /**
     * 登録
     */
    public function register(Request $request)
    {
        $rules = [
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required',
        ];

        $messages = [
          'name.required' => 'ユーザーネームを入力してください',
          'email.required' => 'メールアドレスを入力してください',
          'email.email' => '有効なメールアドレスではありません',
          'email.unique' => '入力されたメールアドレスは既に使われています',
          'password.required' => 'パスワードを入力してください'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {
          return response()->json([
            'success' => false,
            'message' => $validator->errors(),
          ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('appToken')->accessToken;

        return response()->json([
          'success' => true,
          'token' => $success,
          'user' => $user
      ]);
    }

    /**
     * ログアウト
     */
    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }

     /**
      * ユーザーのアイコンを追加・変更
      */
    public function userProfileSave(Request $request){
      $user = Auth::user();

      DB::transaction(function () use($request,$user){
        $input = json_decode($request->all()["data"]);
        if ($request->hasFile('image')) {
          //画像を保存し、ユーザーテーブルにパスを保存する
          $path = $request->file('image')->store('public/user_icons');
          $user->icon_path = basename($path);
        }
  
        $user->name = $input->name;
        $user->save();
      });

      return response()->json(['success' => true,]);
    }

    /**
     * ユーザー情報の取得
     * 作成したプランの取得
     * 参加しているプランの取得
     * 
     * @return json
     */

    public function getUser()
     {
       $user = Auth::user();

       //ユーザーの作成したプランを取得
       $my_plans = Plan::where('user_id',Auth::id())->orderby('id','desc')->get();

       //ユーザーの参加しているプランを取得
       $participating_plans_keys = Member::select(['plan_id'])->where('user_id',Auth::id())->get();
       $participating_plans = Plan::whereIn('id',$participating_plans_keys)->get();

      return response()->json([
        'user' => $user,
        'my_plans' => $my_plans,
        'participating_plans' => $participating_plans,
      ]);
    }
}
