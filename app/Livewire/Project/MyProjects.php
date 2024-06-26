<?php

namespace App\Livewire\Project;

use App\Models\Category;
use App\Models\Project;
use Livewire\Component;
use function view;

class MyProjects extends Component
{
    public array $projects = [];
    public string $category = '';
    public string $status = 'active'; // Новое свойство для статуса
    public array $categories = [];

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->load();
    }

    public function load()
    {
        $query = Project::where('user_id', auth()->user()->id)
            ->where('is_banned', 0);

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->status === 'active') {
            $query->where('status', 'active');
        } elseif ($this->status === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->status === 'completed') {
            $query->where('status', 'completed');
        }

        $this->projects = $query->latest()->get()->toArray();
    }

    public function updated($propertyName)
    {
        $this->load();
    }

    public function render()
    {
        return view('livewire.project.my-projects')->extends('layouts.app');
    }
}
