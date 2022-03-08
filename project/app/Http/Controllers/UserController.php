<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['courses' => function ($q) {
            $q->orderBy('pivot_percentage_passing');
        }])->get();
        return response()->json(['users' => $users], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'email' => "required|email|unique:users,email,{$user->id}|max:256",
            'password' => 'required|string|max:256',
            'phone' =>
                array(
                    "unique:users,phone,{$user->id}",
                    'required',
                    'max:16',
                    'string',
                    'regex:/^\+?[1-9]{1}\(?[0-9]{3}\)?[0-9]{3}-[0-9]{2}-[0-9]{2}$/'
                ),
            'last_name' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
        ]);

        try {
            $user->update($request->all());
            $user->update(['password' => app('hash')->make($request->password)]);
            $user->makeHidden(['password', 'is_admin']);
            return response()->json(['user' => $user, 'message' => 'Success update'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed!'], 409);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            $user->makeHidden(['password', 'is_admin']);
            return response()->json(['user' => $user, 'message' => 'Success delete'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed!'], 409);
        }
    }
}



