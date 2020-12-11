<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
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
    public function userIconSave(Request $request){
      $user = Auth::user();
      if ($request->hasFile('image')) {
        //画像を保存し、ユーザーテーブルにパスを保存する
        $path = $request->file('image')->store('public/user_icons');
        $user->icon_path = $path;
        $user->save();

        return response()->json([
          'success' => true,
          'path' => $path
        ]);
      }
      return response()->json(['success' => false, ]);
    }

     /**
      * ユーザーの取得
      */
     public function getUser()
     {
       $user = Auth::user();

       return $user;
     }
}
