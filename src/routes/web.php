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
Route::get('/register', [AuthController::class, 'user']);
// 登録ボタン(とりあえずTOP画面へ)
Route::post('/',[AuthController::class,'store'])->name('profile');

//ログインボタン(とりあえずユーザ認証なしで遷移)
// Route::get('/',[AdminController::class,'login'])->middleware(['auth'])->name('admin');
Route::get('/',[AdminController::class,'login'])->name('admin');


Route::get('/', [ItemController::class, 'index'])->name('items.index');


Route::post('/item/{item_id}',[ItemController::class,'exhibition']);


//いいね機能
// 一覧表示
Route::get('/mylist', [ItemController::class, 'mylist'])->name('items.mylist');
// いいね追加
Route::post('/mylists/{item}/add', [MylistController::class, 'add'])->name('mylists.add');
// いいね削除
Route::delete('/mylists/{item}/remove', [MylistController::class, 'remove'])->name('mylists.remove');



