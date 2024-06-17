<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CreateProjectController extends Controller
{
    public function index()
    {
        $categories = Category::all()->pluck('name');

        return view('create-project', compact('categories'));
    }

    public function store(CreateProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $category = Category::where('name', $data['category'])->first();
        $data['category_id'] = $category->id;

        if ($data['pay'] == '' && empty($data['pay'])) {
            $data['is_negotiable'] = 1;
        }

        Project::create($data);

        return Redirect::route('user.projects.create')->with('status', 'project-created');
    }
}
