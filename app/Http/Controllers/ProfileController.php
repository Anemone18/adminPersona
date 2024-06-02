<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
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
        $sesi = Session::get('firebaseUserId');
        try {
            $user = $this->auth->getUser($sesi);
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            echo $e->getMessage();
        }
        return view('profile.index')->with('user', $user);
    }

    public function updateProfile (Request $request) {
        $sesi = Session::get('firebaseUserId');
        $properties = [
            'displayName' => $request->newDisplayName,
            'phoneNumber' => $request->newPhoneNumber
        ];
        $updatedUser = $this->auth->updateUser($sesi, $properties);
        return redirect()->route('profile');
    }

    public function updatePassword (Request $request) {
        $request->validate([
            'newPassword'=>'same:confirmNewPassword'
        ]);
        $sesi = Session::get('firebaseUserId');
        $updatedPassword = $this->auth->changeUserPassword($sesi, $request->newPassword);
        return redirect()->route('profile');
    }
}
