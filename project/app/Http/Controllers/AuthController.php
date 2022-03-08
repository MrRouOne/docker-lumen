<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users|max:256',
            'password' => 'required|string|max:256',
            'phone' =>
                array(
                    'unique:users',
                    'required',
                    'max:16',
                    'string',
                    'regex:/^\+?[1-9]{1}\(?[0-9]{3}\)?[0-9]{3}-[0-9]{2}-[0-9]{2}$/'
                ),
            'last_name' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
        ]);

        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => app('hash')->make($request->input('password')),
                'phone' => $request->input('phone'),
                'last_name' => $request->input('last_name'),
                'first_name' => $request->input('first_name')
            ]);
            $user->makeHidden(['password', 'is_admin']);
            return response()->json(['user' => $user, 'message' => 'Success registration'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'User registration failed!'], 409);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Incorrect data'], 401);
        }
        return $this->respondWithToken($token);
    }
}
