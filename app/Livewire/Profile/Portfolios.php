<?php

namespace App\Livewire\Profile;

use App\Models\Portfolio;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Portfolios extends Component
{
    use WithPagination;

    public $user;

    public function mount($uuid)
    {
        $this->user = User::where('uuid', $uuid)->first();
    }


    public function render()
    {
        $portfolios = Portfolio::where('user_id', $this->user->id)->paginate(10);

        return view('livewire.profile.portfolios', [
            'portfolios' => $portfolios
        ])->extends('layouts.app');
    }
}
