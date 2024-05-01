<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictedController extends Controller
{
    public function restricted(Request $request)
    {
        if (Auth::check()) {
            return response()->json("Restricted Area: Logged in users only...");
        } else {
            return response()->json("You are not logged in.", 401);
        }
    }
}