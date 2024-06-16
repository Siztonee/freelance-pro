<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;

class Freelancers extends Component
{
    public $freelancers;
    public $categories;
    public $skills;

    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        $this->freelancers = User::where('type', 'seller')
            ->where('is_activated', 1)
            ->orderBy('rating', 'desc')
            ->get();

        $this->categories = Category::all();
        $this->skills = Skill::all()->pluck('name');
    }

    public function render()
    {
        return view('livewire.freelancers')->extends('layouts.app');
    }
}
