<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalList;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

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
        $item = Item::find($request->item_id);
        if($item["status"] === 0){
            DB::transaction(function () use ($request, $item) {
                $item->status = 1;
                $item->save();

                $rentalList = new RentalList();
                $rentalList->item_id = $request->item_id;
                $rentalList->lending_date = $request->lending_date;
                $rentalList->member_id = $request->member_id;
                $rentalList->save();
                return response()->json(compact('rentalList'), 200);
                }, 5);
            }else{
                return response()->json([
                    "message" => "This is already lent"
                ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (RentalList::where('member_id', $id)->exists()) {
            $rentalList = RentalList::where('member_id', $id)->get();
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
        DB::transaction(function () use ($request, $id) {
            $rentalList = RentalList::find($id);//idに一致するオブジェクトを取得
            $rentalList->back_date = $request->back_date;
            $rentalList->save();

            $item = Item::find($rentalList["item_id"]);
            $item->status = $request->status;
            $item->save();
            return response()->json([
                "message" => "Item status was changed. RentalList was uploaded"
                ]);
    }, 5); //デッドロック発生時のトランザクション再試行回数を指定
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
