<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalList;
use App\Models\Item;


class RentalListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentalLists = RentalList::all();
        return response()->json(compact('rentalLists'),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rentalList = new RentalList();
        $rentalList->item_id = $request->item_id;
        $rentalList->lending_date = $request->lending_date;
        $rentalList->member_id = $request->member_id;
        $rentalList->save();

        return response()->json([
            "message" => "RentalList record created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (RentalList::where('id', $id)->exists()) {
            $rentalList = RentalList::where('id', $id)->get();
            return response()->json(compact('rentalList'),200);
          } else {
            return response()->json([
              "message" => "rentalList not found"
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
    public function update(Request $request, $id)
    {

        return DB::transaction(function () use($id, $request){
            $rentalList = RentalList::find($id)->lockForUpdate();//idに一致するオブジェクトを取得
            $rentalList->back_date = is_null($request->back_date) ? $rentalList->back_date : $request->back_date;
            $item = Item::find($id);
            $item->status = is_null($request->status) ? $item->status : $request->status;

            return [$rentalList, $item];
        }, 5); //ッドロック発生時のトランザクション再試行回数を指定
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
