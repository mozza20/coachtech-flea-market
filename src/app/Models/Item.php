<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['name','category_id','condition_id','brand','description','price','img_url','user_id','comment_id','status','buyer_id'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function mylists(){
        return $this->belongsToMany(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeKeywordSearch($query, $keyword){
        if(!empty($keyword)){
            $query->where('name','LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}