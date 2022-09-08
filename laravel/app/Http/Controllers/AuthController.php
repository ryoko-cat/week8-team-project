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

        Log::warning('ログサンプル', ['memo' => 'sample1']);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        Log::warning($credentials, ['memo' => 'sample1']);
        // Log::warning("start");
        // Log::warning(Auth::attempt($credentials));
        // Log::warning("end");
        $members = Member::find(1);
        Log::warning($members);
        Auth::login($members);
        Log::warning(Auth::login($members));
        Log::warning(Auth::attempt($request->only('email', 'password')));
        if (Auth::login($members)) {
            Log::warning('if');
            $request->session()->regenerate();
            return response()->json(['name' => Auth::user()->email], 200);
        }

        Log::warning('テスト');
        throw new Exception('ログインに失敗しました。再度お試しください');



        // $password = password_verify();

    }

}
