<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;
use Kreait\Auth\Request\CreateUser;

class RegisterController extends Controller
{
    /**
     * Firebase.
     */
    protected $auth;
    protected $database;
    protected $tablename;

    public function __construct()
    {
        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/admin-persona-2ddcc-firebase-adminsdk-bvk1z-607ca3adcc.json')
        ->withDatabaseUri('https://your-database-url.firebaseio.com');

        $this->auth = $factory->createAuth();

        // $this->database = $database;
        // $this->tablename = 'dataUser';
    }

    public function index () {
        // $reference = $this->database->getReference($this->tablename)->getValue();
        return view ('profile.register');
    }
    
    public function store(Request $request)
    {
        $phone = $request->phone ;
        $plus = substr($phone,0,1);
        if ($plus == 0) {
            $newphone = '+62'.substr($phone,1);
        } else {
            $newphone = $request->phone;
        }

        $userPost = [
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $newphone,
            'displayName' => $request->displayName,
        ];

        $createdUser = $this->auth->createUser($userPost);

        if($createdUser) {
            return redirect('profile')->with('Complete insert new event');
        } else {
            return redirect('profile')->with('Failed insert new event');
        }
    }
}
