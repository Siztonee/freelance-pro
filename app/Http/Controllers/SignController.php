<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SignController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    public function auth(): View
    {
        return view('auth.login');
    }
}
