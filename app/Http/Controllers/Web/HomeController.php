<?php

namespace App\Http\Controllers\Web;
use App\Competition;
use App\Http\Controllers\Controller;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $time = time();
        $competitions = Competition::where('start_at', '>', $time)->limit(3)->get();
        $recipes = Recipe::orderBy('created_at', 'desc')->withCount(['likes', 'comments'])->limit(6)->get();
        $users = User::where('role', '=', User::LEADER)->limit(3)->get();
        return view('web.home', compact('competitions', 'recipes', 'users'));
    }
}
