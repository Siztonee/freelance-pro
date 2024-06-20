<?php

namespace App\Livewire\Service;

use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use Livewire\Component;
use function view;

class MyServices extends Component
{
    public array $services = [];
    public string $category = '';
    public string $status = 'active';
    public array $categories = [];

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->load();
    }

    public function load()
    {
        $query = Service::where('user_id', auth()->user()->id)
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

        $this->services = $query->latest()->get()->toArray();
    }

    public function updated($propertyName)
    {
        $this->load();
    }

    public function render()
    {
        return view('livewire.service.my-services')->extends('layouts.app');
    }
}
