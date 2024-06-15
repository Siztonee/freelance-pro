<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Specialization;
use Illuminate\Http\Request;

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
}
