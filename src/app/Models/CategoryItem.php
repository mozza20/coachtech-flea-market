<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $guarded=['user_id','category_id'];
}
