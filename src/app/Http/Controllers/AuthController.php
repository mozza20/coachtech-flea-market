<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;


class AuthController extends Controller
{
    // 会員登録画面表示
    public function user(){
        return view('auth.register');
    }

    // 会員登録ボタン→(プロフィール設定)とりあえず商品詳細画面へ
    public function store(RegisterRequest $request){
        $user=$request->only(['name','email','password']);
        $user['password']=Hash::make($user['password']);
        User::create($user);
        return redirect('/',compact('user'));
    }

    // ログイン画面の表示
    public function showLoginForm(){
        return view('auth.login');
    }
    //ログインボタン→商品詳細画面へ
    public function login(LoginRequest $request){
        $user=$request->only(['email','password']);
        return view('/',compact('user'));
    }
}
