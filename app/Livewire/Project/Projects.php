<?php

namespace App\Livewire\Project;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Livewire\Component;
use function view;

class Projects extends Component
{
    public array $projects = [];
    public array $categories = [];
    public $pay = '';

    protected $queryString = [
        'pay' => ['except' => '']
    ];

    public function mount()
    {
        $this->loadCategories();
        $this->loadProjects();
    }

    public function updatedPay()
    {
        $this->loadProjects();
    }

    public function loadCategories()
    {
        // Загружаем категории в массив
        $this->categories = Category::pluck('name', 'id')->toArray();
    }

    public function loadProjects()
    {
        // Создаем базовый запрос
        $query = Project::where('is_banned', 0)
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderByDesc('users.rating')
            ->select('projects.*')
            ->with('user');

        // Применяем фильтр по оплате
        if ($this->pay) {
            if ($this->pay === '10000+') {
                $query->where('projects.pay', '>', 10000);
            } else {
                list($min, $max) = explode('-', $this->pay);
                $query->whereBetween('projects.pay', [(int)$min, (int)$max]);
            }
        }

        $projects = $query->get();

        // Преобразуем коллекцию проектов в массив и добавляем имя категории
        $this->projects = $projects->map(function ($project) {
            $projectArray = $project->toArray();
            $projectArray['category_name'] = $this->categories[$projectArray['category_id']] ?? 'Unknown';
            return $projectArray;
        })->all();
    }


    public function render()
    {
        return view('livewire.project.projects')->extends('layouts.app');
    }
}
