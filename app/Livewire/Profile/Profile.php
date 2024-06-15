<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public function mount($uuid)
    {
        $this->user = User::where('uuid', $uuid)->first();
    }

    public function render()
    {
        return view('livewire.profile.profile')->extends('layouts.app');
    }
}
