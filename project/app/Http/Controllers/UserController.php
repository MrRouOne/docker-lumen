<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $user = User::create($request->all());

        return response()->json(   [
            'data'=>[
                'id'=>$user->id,
                'status'=>'created'
            ]
        ],201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json(   [
            'data'=>[
                'id'=>$user->id,
                'status'=>'updated'
            ]
        ],200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(   [
            'data'=>[
                'id'=>$user->id,
                'status'=>'deleted'
            ]
        ],200);
    }
}



