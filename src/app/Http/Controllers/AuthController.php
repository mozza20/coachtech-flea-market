<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
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
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // ログイン
        Auth::login($user);
        return redirect('/');
    }


    // ログイン画面の表示
    public function showLoginForm(){
        return view('auth.login');
    }
    //ログインボタン→商品詳細画面へ
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'ログイン情報が登録されていません',
        ])->withInput();
    }

    // プロフィール設定画面(とりあえず)表示
    public function profile(){
        return view('profile');
    }
}
