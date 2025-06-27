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
use App\Models\Mylist;


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
        // メール認証用のメール送信
        $user->sendEmailVerificationNotification();

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

            if(!Auth::user()->hasVerifiedEmail()){
                $user = Auth::user();
                // メール認証用のメール送信
                $user->sendEmailVerificationNotification();
                return redirect()->route('verification.notice');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'ログイン情報が登録されていません',
        ])->withInput();
    }

    // トップページの表示(タブ切り替え)
    public function index(Request $request){
        $user=Auth::user();
        // 検索キーワードを反映
        $keyword = $request->keyword;
        $tab = $request->tab;

        if($tab === 'mylist'){
            if($user){
                $mylistIds=Mylist::where('user_id', $user->id)
                ->pluck('item_id');

                $items=Item::whereIn('id',$mylistIds)
                ->when($keyword, function ($query, $keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })->with('categories','condition')->get();
            }else{
                $items=collect(); //未ログインの時は空
            }
        }else{
            $userId = optional($user)->id;

            $items = Item::with('categories', 'condition')
            ->when($userId, fn($query)=>$query->where('user_id', '!=', $userId))
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();
        }
           
        return view('top',compact('items', 'tab'));
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

    //ログアウト
    public function logout(Request $request){
        Auth::logout();
        // セッションの全データ削除
        $request->session()->invalidate();
        // CSRFトークンの再発行
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // マイページの表示(タブ切り替え)
    public function mypage(Request $request){
        $user=Auth::user();

        if($request->tab==='buy'){
            if($user){
                $purchaseId=Item::where('buyer_id', $user->id)
                ->pluck('id');
                $items=Item::whereIn('id',$purchaseId)->with('categories','condition')->get();
            }else{
                $items=collect();
            }
        }else{
            $items = Item::with('categories', 'condition')
            ->where('user_id',$user['id'])
            ->get();
        }
        
        return view('mypage',compact('user','items'));
    }
}
