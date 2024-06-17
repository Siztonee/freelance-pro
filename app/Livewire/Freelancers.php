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
        $this->freelancers = User::where('type', 'seller')
            ->where('is_activated', 1)
            ->where(function($query) {
                foreach ($this->selectedSkills as $skill) {
                    $query->whereRaw("FIND_IN_SET(?, skills)", [$skill]);
                }
            })
            ->orderBy('rating', 'desc')
            ->get();
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
