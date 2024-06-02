<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Contract\Database;

class UserListController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/admin-persona-2ddcc-firebase-adminsdk-bvk1z-607ca3adcc.json')
        ->withDatabaseUri('https://your-database-url.firebaseio.com');

        $this->auth = $factory->createAuth();
    }

    public function index()
    {
        $users = $this->auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
        foreach ($users as $user) {
            return view('userlist.index', compact('users'));
        }
    }
}
