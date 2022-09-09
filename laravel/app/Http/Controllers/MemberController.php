<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function getAllMembers()
    {
        $member = Member::get()->toJson(JSON_PRETTY_PRINT);
        return response($member, 200);
    }

    public function getMember($id)
    {
        if (Member::where('id', $id)->exists()) {
            $member = Member::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($member, 200);
          } else {
            return response()->json([
              "message" => "Member not found"
            ], 404);
          }
    }

    public function updateMember(Request $request, $id)
    {
        // roleのみを変更できる想定
        if (Member::where('id', $id)->exists()) {
            $member = Member::find($id);
            $member->role = is_null($request->role) ? $member->role : $request->role;
            $member->save();
      
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Member not found"
            ], 404);
              
        }
    }

    public function deleteMember($id)
    {
        if(Member::where('id', $id)->exists()) {
            $member = Member::find($id);
            $member->delete();
      
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Member not found"
            ], 404);
          }
    }
}
