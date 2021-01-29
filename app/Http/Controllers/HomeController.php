<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('sms');
    }
    public function portal()
    {
        $user = Auth::user();
        return view('welcome', compact('user'));
    }
}
