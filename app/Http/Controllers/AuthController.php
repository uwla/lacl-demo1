<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'token_name' => 'required|string|min:3|max:20|regex:/^[a-z0-9_-]+$/i',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if (! Hash::check($request->password, $user->password))
        {
            return response('Login invalid', 503);
        }

        return $user->createToken($request->token_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        // delete current token
        $request->user()->currentAccessToken()->delete();

        // return response
        return new Response(status: 204);
    }

    public function profile(Request $request)
    {
        return $request->user();
    }
}
