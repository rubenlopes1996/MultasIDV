<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function addUser(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|string',
            'active' => 'required|boolean',
            'position' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->active = $request['active'];
        $user->position = $request['position'];
        $user->save();

        return response()->json($user, 201);
    }

    public function editUser(Request $request, $id)
    {
        $request = $request->validate([
            'name' => 'required|string',
            'active' => 'required|boolean',
            'position' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->active = $request['active'];
        $user->position = $request['position'];
        $user->save();

        return response()->json($user, 200);
    }

    public function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json($user, 200);
    }
}
