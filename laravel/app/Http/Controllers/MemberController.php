<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全件取得
        $members = Member::all();
        return $members->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新規登録(名前、メールアドレス、パスワード)
        // パスワードはハッシュ化して登録
        $member->fill(array_merge($request->all(),
           ['password' => Hash::make($request->password)]
        ))->save();
        return $member;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 会員別の情報取得：ID別
        $member = Member::find($id);
        return $member->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // role権限の変更
        $member=Member::find($id);
        
        // もし1だったら2に変更、2だったら1に変更
        if () {
            $member->save();
        } else {
            //
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 機能追加時に使用：今回は使わない可能性あり
        $member=Member::find($id);
        $member->delete();
    }
}
