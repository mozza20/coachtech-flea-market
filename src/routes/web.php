<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MylistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailTestController; // メール認証用
use App\Http\Controllers\PaymentController; //stripe

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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


// メール認証画面
Route::get('/email/verify',function(){
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// メール認証リンクからのアクセス
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // メール確認済み状態にする
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール再送信処理
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '確認リンクを再送信しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//トップページ表示 (ログインしてなくても表示)
Route::get('/', [AuthController::class, 'index'])->name('top');


//商品詳細画面の表示
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('exhibition');


// ログイン必須画面
Route::middleware('auth','verified')->group(function () {
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

    // // 購入
    // Route::post('/purchase/{item_id}/complete',[ItemController::class,'purchaseComplete'])->name('purchase.complete');

    // 住所変更画面表示
    Route::get('/purchase/address/{item_id}',[ItemController::class,'address'])->name('purchase.address');

    // 住所の変更
    Route::post('/purchase/address/{item_id}',[ItemController::class,'addressEdit'])->name('address.edit');

    // stripeでの支払い
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [PaymentController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel/{item_id}', [PaymentController::class, 'cancel'])->name('checkout.cancel');

    //いいね機能
    // 一覧表示
    Route::get('/?tab=mylist', [ItemController::class, 'mylist'])->name('items.mylist');

    // // いいね追加・削除
    Route::post('/items/{item_id}/toggle-like', [ItemController::class, 'toggleLike'])->name('items.toggleLike');

    

});


// ログアウト
Route::middleware('auth')->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
