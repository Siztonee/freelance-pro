<?php

namespace App\Livewire\Project;

use App\Models\Category;
use App\Models\Skill;
use App\Services\ProjectService;
use Livewire\Component;
use function view;

class Projects extends Component
{
    public array $projects;
    public array $categories;
    public string $pay = '';
    public string $category = '';
    public array $selectedSkills = [];
    public array $skills;

    protected ProjectService $projectService;

    public function __construct()
    {
        $this->projectService = app(ProjectService::class);
    }

    public function mount()
    {
        $this->loadCategories();
        $this->loadProjects();
    }

    public function updatedPay()
    {
        $this->loadProjects();
    }

    public function updatedCategory()
    {
        $this->loadProjects();
    }

    public function loadSkills()
    {
        $category = Category::where('id', $this->category)->first();
        $this->skills = Skill::where('category_id', $category->id)->pluck('name')->toArray();
    }

    public function searchBySkills($skill)
    {
        if (in_array($skill, $this->selectedSkills)) {
            $this->selectedSkills = array_diff($this->selectedSkills, [$skill]);
        } else {
            $this->selectedSkills[] = $skill;
        }

        $this->loadProjects();
    }

    public function deleteSkill($skill)
    {
        $this->selectedSkills = array_diff($this->selectedSkills, [$skill]);
        $this->loadProjects();
    }

    public function loadCategories()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
    }

    public function loadProjects($skill = null)
    {
        $this->projects = $this->projectService->loadProjects($this->pay, $this->category, $this->selectedSkills);
        if (!empty($this->category)) {
            $this->loadSkills();
        }


    }



    public function render()
    {
        return view('livewire.project.projects')->extends('layouts.app');
    }
}
