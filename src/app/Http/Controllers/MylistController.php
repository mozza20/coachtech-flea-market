<?php

namespace App\Http\Controllers;

use App\Models\Mylist;
use Illuminate\Http\Request;

class MylistController extends Controller
{
    public function add($itemId){
        Auth::user()->mylists()->attach($itemId);
        return back();
    }

    public function remove($itemId){
        Auth::user()->mylists()->detach($itemId);
        return back();
    }

    
}
