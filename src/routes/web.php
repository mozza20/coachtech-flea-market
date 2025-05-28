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
Route::get('/login',[AuthController::class,'showLoginForm'])->name('auth.login');

//ログイン処理
Route::post('/login',[AuthController::class,'login'])->middleware(['auth'])->name('login');

//ログイン処理後のトップページ表示 
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
});

// プロフィール設定画面の表示
Route::get('/mypage/profile',[AuthController::class,'profile'])->name('profile');

// プロフィールの更新
Route::patch('/mypage/profile',[AuthController::class,'update'])->name('update');

// ログアウト
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/', [ItemController::class, 'index'])->name('items.index');


Route::post('/item/{item_id}',[ItemController::class,'exhibition'])->name('exhibition');


//いいね機能
// 一覧表示
Route::get('/mylist', [ItemController::class, 'mylist'])->name('items.mylist');
// いいね追加
Route::post('/mylists/{item}/add', [MylistController::class, 'add'])->name('mylists.add');
// いいね削除
Route::delete('/mylists/{item}/remove', [MylistController::class, 'remove'])->name('mylists.remove');



