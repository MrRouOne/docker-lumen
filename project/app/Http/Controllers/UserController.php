<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->load(['courses' => function ($q) {
                $q->orderBy('pivot_percentage_passing');
            }]);
        }

        return response()->json(['users' => $users], 409);
    }

    public function create(Request $request)
    {
        $user = User::create($request->all());

        return response()->json([
            'data' => [
                'id' => $user->id,
                'status' => 'created'
            ]
        ], 201);
    }

    public function update(Request $request, $id)
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
            $user = User::find($id);
            $user->update($request->all());
            $user->update(['password' => app('hash')->make($request->password)]);

            return response()->json([
                'data' => [
                    'id' => $user->id,
                    'status' => 'updated'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed!'], 409);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                'data' => [
                    'id' => $user->id,
                    'status' => 'deleted'
                ]
            ], 200);


        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed!'], 409);
        }


    }
}



