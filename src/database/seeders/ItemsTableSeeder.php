<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Str;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ダミーアカウントを作成
        $users=collect();
        for($i=1; $i<=3; $i++){
            $users->push(User::create([
                'name' => '山田太郎' . $i,
                'email' => 'test' . $i . '@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]));
        }

        // コンディション・カテゴリをIDにマッピング
        $conditionMap = Condition::pluck('id', 'selection');
        $categoryMap = Category::pluck('id', 'content');

        $items=[
            [
                'name' => '腕時計',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'img_url' => 'items/product_Armani_Mens_Clock.jpg',
                'categories'=>['メンズ','ファッション'],
                'condition' => '良好',
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'img_url' => 'items/product_HDD_Hard_Disk.jpg',
                'categories'=>'家電',
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'img_url' => 'items/product_iLoveIMG_d.jpg',
                'categories'=>'キッチン',
                'condition' => 'やや傷や汚れあり',
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'img_url' => 'items/product_Leather_Shoes_Product_Photo.jpg',
                'categories'=>'メンズ',
                'condition' => '状態が悪い',
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'img_url' => 'items/product_Living_Room_Laptop.jpg',
                'categories'=>'家電',
                'condition' => '良好',
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'img_url' => 'items/product_Music_Mic_4632231.jpg',
                'categories'=>'家電',
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'img_url' => 'items/product_Purse_fashion_pocket.jpg',
                'categories'=>'ファッション',
                'condition' => 'やや傷や汚れあり',
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'img_url' => 'items/product_Tumbler_souvenir.jpg',
                'categories'=>'キッチン',
                'condition' => '状態が悪い',
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'img_url' => 'items/product_Waitress_with_Coffee_Grinder.jpg',
                'categories'=>'キッチン',
                'condition' => '良好',
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'img_url' => 'items/product_外出メイクアップセット.jpg',
                'categories'=>'レディース',
                'condition' => '目立った傷や汚れなし',
            ],
        ];

        foreach ($items as $itemData) {
            $item = Item::create([
                'name' => $itemData['name'],
                'price' => $itemData['price'],
                'description' => $itemData['description'],
                'img_url' => $itemData['img_url'],
                'condition_id' => $conditionMap[$itemData['condition']] ?? 1,
                'user_id' => $users->random()->id,
            ]);

            // カテゴリを関連づける
            $categoryIds = collect($itemData['categories'])->map(function ($name) use ($categoryMap) {
                return $categoryMap[$name] ?? null;
            })->filter()->all();
            // 多対多リレーション
            $item->categories()->attach($categoryIds);
        }
    }
}
