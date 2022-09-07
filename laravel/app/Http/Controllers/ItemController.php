<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function getAllitems()
    {
        // DBよりBookテーブルの値を全て取得
         $items = Item::all();
         return response()->json(compact('items'),200);
    }
}
