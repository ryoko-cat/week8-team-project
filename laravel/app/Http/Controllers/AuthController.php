<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $member = new Member;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $member->role = $request->role;
        $member->save();

        return response()->json([
            "message" => "member record created"
        ], 201);
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['user_id' => Auth::user()->id, 'role' => Auth::user()->role], 200);
        }

        throw new Exception('ログインに失敗しました。再度お試しください');

    }

    public function showAuth()
    {
        return Auth::user();
    }

}
