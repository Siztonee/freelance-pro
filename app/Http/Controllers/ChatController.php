<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->user()->id)->get()->toArray();

        return view('chat', compact('users'));
    }
}
