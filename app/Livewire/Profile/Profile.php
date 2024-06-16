<?php

namespace App\Livewire\Profile;

use App\Models\Portfolio;
use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $skills;
    public $portfolios;

    public function mount($uuid)
    {
        $this->user = User::where('uuid', $uuid)->first();

        if ($this->user->skills) {
            $this->skills = explode(',', $this->user->skills);
        }

        $this->portfolios = Portfolio::where('user_id', $this->user->id)
            ->limit(3)
            ->latest()
            ->get();    }

    public function render()
    {
        if ($this->user->type == 'buyer') {
            return view('livewire.profile.buyer-profile')->extends('layouts.app');
        }
        return view('livewire.profile.profile')->extends('layouts.app');
    }
}
