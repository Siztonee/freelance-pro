<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\CreateServiceRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CreateServiceController extends Controller
{
    public function index()
    {
        $categories = Category::all()->pluck('name');

        return view('create-service', compact('categories'));
    }

    public function store(CreateServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $category = Category::where('name', $data['category'])->first();
        $data['category_id'] = $category->id;

        if ($data['pay'] == '' && empty($data['pay'])) {
            $data['is_negotiable'] = 1;
        }

        Service::create($data);

        return Redirect::route('user.services.create')->with('status', 'service-created');
    }
}
