<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use function view;

class SettingsController extends Controller
{
    public function __invoke()
    {
        return view('profile.settings');
    }
}
