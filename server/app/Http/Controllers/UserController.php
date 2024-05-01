<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index() {

        $users = User::all();
        return response()->json($users);

    }

    public function create() { }

    public function store(Request $request) {

        $user = User::create($request->all());
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);

    }

    public function show($id) {

        $user = User::find($id);

        if (!$user) return response()->json(['error' => 'User not found'], 404);
        return response()->json($user);

    }

    public function edit($id) { }

    public function update(Request $request, $id) {

        $user = User::find($id);

        if (!$user) return response()->json(['error' => 'User not found'], 404);
        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);

    }

    public function destroy($id) {

        $user = User::find($id);

        if (!$user) return response()->json(['error' => 'User not found'], 404);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);

    }

    public function login(Request $request) {

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
            return response()->json(['error' => 'Login failed'], 401);

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response(['user' => $user, 'token' => $token]);
        
    }

    public function logout(Request $request) {
        
        /** @var User $user */
        $request->user()->currentAccessToken()->delete();
        // Auth::logout();

        return response()->json(['message' => 'Logout successful']);

    }

}