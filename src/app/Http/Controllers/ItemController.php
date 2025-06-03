<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
        ],
        [
            'name.required'=>'商品名を入力してください',
        ]);

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
        if ($request->hasFile('item_url')) {
            $path = $request->file('item_url')->store('items', 'public');
            $product['item_url'] = $path;
        }
        $item=Item::create($product);

        // カテゴリの紐づけ
        $item->categories()->attach($request->input('category_ids'));

        return redirect('/mypage');
    }

    public function exhibit(Request $request){
        $item=Item::with('id')->get();
        return view('exhibition',compact('item'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item){
        $items=$request->all();
        $category=Category::find($request->category_id);
        $condition=Condition::find($request->condition_id);
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
