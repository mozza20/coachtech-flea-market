<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['item_name','category_id','condition_id','brand','describe','price','item_url','comment_id','item_status'];

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function condition(){
        return $this->belongsTo(Condition::class)->withTimestamps();
    }

    public function likedUsers(){
        return $this->belongsToMany(User::class, 'mylists')->withTimestamps()->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class)->withTimestamps();
    }
}