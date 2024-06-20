<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function loadProjects($pay, $category, $selectedSkills)
    {
        $query = Project::where('is_banned', 0)
            ->with('user')
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->orderByDesc('users.rating')
            ->select('projects.*');

        if ($pay) {
            if ($pay === '10000+') {
                $query->where('projects.pay', '>', 10000);
            } else {
                list($min, $max) = explode('-', $pay);
                $query->whereBetween('projects.pay', [(int)$min, (int)$max]);
            }
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if (!empty($selectedSkills)) {
            foreach ($selectedSkills as $skill) {
                // Очищаем навык от потенциальных SQL инъекций
                $skill = trim($skill);
                $skill = str_replace("'", "''", $skill); // Экранирование одинарных кавычек для SQL запроса

                // Добавляем условие поиска для каждого навыка
                $query->whereRaw("FIND_IN_SET(?, requirement_skills) > 0", [$skill]);
            }
        }

        $projects = $query->get();

        return $projects->map(function ($project) {
            $projectArray = $project->toArray();
            $projectArray['category_name'] = $project->category->name ?? 'Unknown';
            return $projectArray;
        })->all();
    }

}
