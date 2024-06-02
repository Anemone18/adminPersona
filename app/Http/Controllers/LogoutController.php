<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index () {
        session()->forget('firebaseUserId');
        session()->forget('idToken');
        session()->forget('displayName');
        session()->flush();
        return redirect()->route('login');
    }
}
