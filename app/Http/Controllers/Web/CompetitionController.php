<?php

namespace App\Http\Controllers\Web;
use App\Competition;
use App\Http\Controllers\Controller;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function getCompetitions()
    {
        $time = time();
        $user = auth()->user();
        $competitionType = $user->role === User::LEADER ? Competition::PROFESSIONAL : Competition::AMATEUR;
        $competitions = Competition::where('type', '=', $competitionType)
            ->where(function($query) use ($time) {
                $query->where('start_at', '>', $time)
                            ->orWhere(function ($query1) use ($time) {
                                $query1->where('start_at', '<=', $time);
                                $query1->where('end_at', '>', $time);
                            });
                })->orderBy('start_at', 'asc')->get();
        $competitions->each(function(Competition $competition) {
            $competition->start_at = date("d/m/Y", $competition->start_at);
            $competition->end_at = date("d/m/Y", $competition->end_at);
        });
        return view('web.competitions', compact('competitions'));
    }
}
