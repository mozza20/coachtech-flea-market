<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Item;


class AuthController extends Controller
{
    // 会員登録画面表示
    public function user(){
        return view('auth.register');
    }

    // 会員登録ボタン→プロフィール設定画面へ
    public function store(RegisterRequest $request){
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // ログイン
        Auth::login($user);
        return redirect('/mypage/profile');
    }


    // ログイン画面の表示
    public function showLoginForm(){
        return view('auth.login');
    }
    //ログインボタン→トップページへ
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            //セキュリティ強化
            $request->session()->regenerate(); 
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'ログイン情報が登録されていません',
        ])->withInput();
    }

    // トップページの表示(ItemControllerにも同じ記述あり)
    public function index(){
        $items = Item::with('categories', 'condition')->get();
        return view('top', compact('items'));
    }

    // プロフィール設定画面表示
    public function profile(){
        $user=Auth::user();
        return view('profile',compact('user'));
    }

    // プロフィールの更新
    public function update(ProfileRequest $request){
        $user=Auth::user();
        $user->update($request->all());
        return redirect('/');
    }

    //ログアウト(とりあえずログイン画面へ遷移させる)
    public function logout(Request $request){
        Auth::logout();
        // セッションの全データ削除
        $request->session()->invalidate();
        // CSRFトークンの再発行
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // マイページの表示
    public function mypage(){
        $user=Auth::user();
        $items = Item::with('categories', 'condition')->get();
        return view('mypage',compact('user','items'));
    }
}
