<?php

namespace App\Livewire\Service;

use App\Models\Category;
use App\Models\Service;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;
use function view;

class Services extends Component
{
    public $services;
    public $categories;
    public $selectedCategory;
    public $skills;
    public $skill_links;
    public array $selectedSkills;

    public function mount()
    {
        $this->load();
    }

    public function selectCategory($id)
    {
        $this->selectedCategory = Category::find($id);
        $this->filterFreelancers();
        $this->skill_links = Skill::where('category_id', $this->selectedCategory->id)
            ->pluck('name');
    }

    public function searchBySkills($skill)
    {
        if (in_array($skill, $this->selectedSkills)) {
            $this->selectedSkills = array_diff($this->selectedSkills, [$skill]);
        } else {
            $this->selectedSkills[] = $skill;
        }

        $this->filterFreelancers();
    }

    public function deleteSkill($skill)
    {
        $this->selectedSkills = array_diff($this->selectedSkills, [$skill]);
        $this->filterFreelancers();
    }

    public function filterFreelancers()
    {
        $this->services = Service::where('is_banned', 0)
            ->where('status', 'active')
            ->where(function($query) {
                foreach ($this->selectedSkills as $skill) {
                    $query->whereRaw("FIND_IN_SET(?, skills)", [$skill]);
                }
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('services.category_id', $this->selectedCategory->id);
            })
            ->join('users', 'services.user_id', '=', 'users.id')
            ->with('category')
            ->select('services.*', 'users.rating')
            ->orderBy('users.rating', 'desc')
            ->get();
    }

    public function load()
    {
        $this->services = Service::where('is_banned', 0)
            ->where('status', 'active')
            ->join('users', 'services.user_id', '=', 'users.id')
            ->with('category')
            ->select('services.*', 'users.rating')
            ->orderBy('users.rating', 'desc') // или 'asc' для сортировки по возрастанию
            ->get();

        $this->categories = Category::all();
        $this->skills = Skill::all()->pluck('name');
    }

    public function render()
    {
        return view('livewire.service.services')->extends('layouts.app');
    }
}
