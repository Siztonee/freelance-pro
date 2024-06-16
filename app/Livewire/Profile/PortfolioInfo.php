<?php

namespace App\Livewire\Profile;

use App\Models\Portfolio;
use App\Models\User;
use Livewire\Component;

class PortfolioInfo extends Component
{
    public $portfolio;
    public $user;

    public function mount($uuid, $id)
    {
        $this->user = User::where('uuid', $uuid)->first();
        $this->portfolio = Portfolio::where('user_id', $this->user->id)->where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.profile.portfolio-info')->extends('layouts.app');
    }
}
