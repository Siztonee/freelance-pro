<?php

namespace App\Livewire\Components;

use Livewire\Component;

class RedirectComponent extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function respond()
    {
        return redirect()->route('user.chat', ['receiver_id' => $this->project['user_id']]);
    }


    public function render()
    {
        return view('livewire.components.redirect-component');
    }
}
