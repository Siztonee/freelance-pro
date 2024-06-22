<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($receiver_id = null)
    {
        $users = User::whereNot('id', auth()->user()->id)->get()->toArray();

        if ($receiver_id !== null) {
            return view('chat', compact('users', 'receiver_id'));
        }

        return view('chat', compact('users'));
    }
}
