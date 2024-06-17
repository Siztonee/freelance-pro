<?php

namespace App\Livewire\Project;

use Livewire\Component;
use function view;

class MyProjects extends Component
{
    public function render()
    {
        return view('livewire.project.my-projects')->extends('layouts.app');
    }
}
