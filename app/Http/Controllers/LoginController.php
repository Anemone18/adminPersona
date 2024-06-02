<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class LoginController extends Controller
{
    protected $auth;
    public function __construct()
    {
        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/admin-persona-2ddcc-firebase-adminsdk-bvk1z-607ca3adcc.json')
        ->withDatabaseUri('https://your-database-url.firebaseio.com');

        $this->auth = $factory->createAuth();
    }

    public function index () {
        return view ('login.index');
    }

    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            Session::put('firebaseUserId', $signInResult->firebaseUserId());
            Session::put('idToken', $signInResult->idToken());
            Session::put('displayName', $signInResult->data()['displayName']);
            return redirect()->route('dashboard')->with('success', 'Login Succes');

        } catch (\Throwable $e) {
            return redirect()->route('login')->with('loginFailed','Login Failed! Please Try Again');
        }
    }
}
