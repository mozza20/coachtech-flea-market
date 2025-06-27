<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Mylist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;

class ItemController extends Controller
{
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

        // いいねしているかどうか判断
        $user = Auth::user();
        $likedItemIds = $user
        ? Mylist::where('user_id', $user->id)->pluck('item_id')->toArray()
        : [];

        return view('exhibition',compact('item','comments','likedItemIds'));
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

        $address = Address::where('user_id', $user->id)
        ->where('item_id', $item->id)
        ->latest() // 複数ある場合、最新のもの
        ->first();

        return view('purchase',compact('item','user','address'));
    }

    // 購入
    public function purchaseComplete(PurchaseRequest $request,$item_id){
        // 該当の商品を取得
        $item = Item::findOrFail($item_id);
        $item->status='sold';
        $item->buyer_id=Auth::id();
        $item->save();

        return redirect('/');
    }

    // 住所変更画面表示
    public function address($item_id){
        $item = Item::findOrFail($item_id);
        $user=Auth::user();
        return view('address',compact('item','user'));
    }

    // 住所変更
    public function addressEdit(AddressRequest $request,$item_id){

        $item = Item::findOrFail($item_id);
        $user=Auth::user();

        $address=Address::create([
            'user_id'=>$user->id,
            'item_id'=>$item->id,
            'post_code'=>$request->input('post_code'),
            'address'=>$request->input('address'),
            'building'=>$request->input('building'),
        ]); 
  
        return redirect()->route('purchase',['item_id'=>$item->id]);
    }

    public function toggleLike($item_id){
        $item = Item::findOrFail($item_id);
        $user=Auth::user();
        // すでに「いいね」しているか確認
        $existingLike = Mylist::where('user_id', $user->id)
        ->where('item_id', $item->id)
        ->first();

        if ($existingLike) {
            // すでにいいねされていたら解除
            $existingLike->delete();
            $item->decrement('like_count');
            $liked = false;
        }else{
            // 新しい「いいね」する
            Mylist::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            $item->increment('like_count');
            $liked = true;
        }
        //Ajax用にJSONで返す(リロードせずにいいねを反映)
        return response()->json([
            'liked' => $liked,
            'like_count' => $item->like_count,
        ]);
    }

    // 検索機能
    public function search(Request $request){
        $items=Item::with('categories','condition')
        ->KeywordSearch($request->keyword)->get();
        return view('top',compact('items'));
    }






}
