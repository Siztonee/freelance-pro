<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Redirect;

class AddPortfolio extends Controller
{
    public function index()
    {
        return view('profile.add-portfolio');
    }

    public function add(AddPortfolioRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['media'] = $request->file('media')->store('public/portfolios');

        Portfolio::create($data);

        return Redirect::route('user.portfolio.list', auth()->user()->uuid)->with('status', 'portfolio-created');
    }
}
