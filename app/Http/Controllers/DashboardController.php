<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index () {
        return view('dashboard.index');
    }
}
