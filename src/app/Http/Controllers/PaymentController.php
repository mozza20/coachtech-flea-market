<?php

namespace App\Http\Controllers;
use App\Models\Item;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

use App\Http\Requests\PurchaseRequest;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $item_id = $request->input('item_id');
        $item=Item::findOrFail($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));
    
        $itemName =$item->name ;
        $amount = $item->price ;
    
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $itemName,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel', ['item_id' => $item->id]),
        ]);
    
        return redirect($session->url);
    }
    
    // public function success()
    // {
    //     return view('payment.success'); // 支払い完了画面
    // }
    
    public function cancel($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $address = $user->address ?? null;

        return view('purchase', [
            'item' => $item,
            'user' => $user,
            'address' => $address,
            'message' => 'キャンセルされました',
        ]);
    }
}
