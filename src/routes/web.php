<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MylistController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//登録画面の表示
Route::get('/register', [AuthController::class, 'user'])->name('auth.register');

// 登録ボタンで登録内容を保存
Route::post('/register',[AuthController::class,'store'])->name('register');

//ログイン画面の表示
Route::get('/login',[AuthController::class,'showLoginForm'])->middleware('guest')->name('auth.login');

//ログイン処理
Route::post('/login',[AuthController::class,'login'])->middleware(['guest'])->name('login');

//トップページ表示 (ログインしてなくても表示)
Route::get('/', [AuthController::class, 'index']);

//商品詳細画面の表示
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('exhibition');


// ログイン必須画面
Route::middleware('auth')->group(function () {
    // プロフィール設定画面の表示
    Route::get('/mypage/profile',[AuthController::class,'profile'])->name('profile');

    // プロフィールの更新
    Route::patch('/mypage/profile',[AuthController::class,'update'])->name('update');

    // 商品詳細画面でのコメント
    Route::post('/item/{item_id}',[ItemController::class,'storeComment'])->name('store.comment');


    // マイページの表示
    Route::get('/mypage',[AuthController::class,'mypage'])->name('mypage');

    // 出品画面表示
    Route::get('/sell',[ItemController::class,'sell'])->name('sell');

    // 出品
    Route::post('/sell',[ItemController::class,'store'])->name('product.sell');

    //購入画面の表示
    Route::get('/purchase/{item_id}',[ItemController::class,'purchase'])->name('purchase');

    // 購入
    Route::post('/purchase/{item_id}/complete',[ItemController::class,'purchaseComplete'])->name('purchase.complete');

    // 住所変更画面表示
    Route::get('/purchase/address/{item_id}',[ItemController::class,'addressEdit'])->name('purchase.address');

    //いいね機能
    // 一覧表示
    Route::get('/?tab=mylist', [ItemController::class, 'mylist'])->name('items.mylist');

    // // いいね追加・削除
    Route::post('/items/{item_id}/toggle-like', [ItemController::class, 'toggleLike'])->name('items.toggleLike');

    // ログアウト
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});


// いいね・コメントの追加(商品詳細画面)
// Route:post('/item/{item_id}',[ItemController::class,'add'])->name('exhibition');






