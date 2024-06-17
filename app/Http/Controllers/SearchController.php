<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchSpec(Request $request)
    {
        $query = $request->input('query');
        $results = Specialization::where('name', 'LIKE', "%{$query}%")->limit(3)->get();

        return response()->json($results);
    }

    public function searchSkill(Request $request)
    {
        $query = $request->input('query');
        $results = Skill::where('name', 'LIKE', "%{$query}%")->limit(3)->get();

        return response()->json($results);
    }

    public function searchFreelancer(Request $request)
    {
        $categoryId = $request->input('category_id');
        $skills = Skill::where('category_id', $categoryId)->get();

        return response()->json(['skills' => $skills]);
    }

}
