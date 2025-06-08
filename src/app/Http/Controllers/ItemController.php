<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\CommentRequest;

class ItemController extends Controller
{
    // トップページを表示(AuthControllerにも同じ記述あり)
    public function index(){
        $items = Item::with('categories', 'condition')->get();
        return view('top', compact('items'));
    }
    // user()の後ろに->mylists()、自分が出品した商品以外の表示コードを入れる
    // ログインしたときとしてないときの表示を変える

    //出品画面表示
    public function sell(){
        $categories=Category::all();
        $conditions=Condition::all();
        return view('sell',compact('categories','conditions'));
    }

    // 商品の出品
    public function store(ExhibitionRequest $request){
        $product=$request->only([
            'name',
            'img_url',
            'condition_id',
            'brand',
            'description',
            'price',
        ]);

         // 商品出品者を紐づける
        $product['user_id'] = auth()->id();

        // ファイルアップロード処理
        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('items', 'public');
            $product['img_url'] = $path;
        }
        $item=Item::create($product);

        // カテゴリの紐づけ
        $item->categories()->attach($request->input('category_ids'));

        return redirect('/mypage');
    }

    // 商品詳細画面の表示
    public function show($item_id){
        $item=Item::with('categories','condition')->findOrFail($item_id);
        $comments =$item->comments()->with('user')->get();
        return view('exhibition',compact('item','comments'));
    }
    // コメントの投稿
    public function storeComment(CommentRequest $request, $item_id){
        $item = Item::findOrFail($item_id);
        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id, 
            'content' => $request->input('content'),
        ]);
        return redirect("/item/{$item_id}");
    }

    // 購入画面の表示
    public function purchase($item_id){
        $item=Item::with('categories','condition')->findOrFail($item_id);
        $user=Auth::user();
        return view('purchase',compact('item','user'));
    }

    // 購入
    public function purchaseComplete(PurchaseRequest $request,$item_id){
        // 該当の商品を取得
        $item = Item::findOrFail($item_id);
        $item->status='sold';
        $item->buyer_id=Auth::id();
        $item->save();
        return redirect('/')->with('purchase_complete', '購入が完了しました');
    }



    public function add(Request $request){
        //いいねを追加
    }


    public function liked(){
        $items = Auth::user()->mylists;
        return view('items.mylist', compact('items'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
