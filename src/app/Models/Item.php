<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['item_name','category_id','condition_id','brand','describe','price','item_image','comment_id','item_status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

}