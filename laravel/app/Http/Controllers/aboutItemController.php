<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Item;


class aboutItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json(compact('items'),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //post
    {
        $item = new Item();
        if(is_string($request->title) && is_string($request->description)) {
            $item->title = $request->title;
            $item->description = $request->description;
            $item->category_id = $request->category_id;
            $item->period_id = $request->period_id;
            $item->save();
            return response()->json([
                "message" => "Item record created"
            ], 201);
    
        }else{
            return response()->json([
                "message" => "no created"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //idでget
    {
        if (Item::where('id', $id)->exists()) {
            $item = Item::where('id', $id)->get();
            return response()->json(compact('item'),200);
          } else {
            return response()->json([
              "message" => "Item not found"
            ], 404);
          }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //patch
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //delete
    {
        //
    }
}
