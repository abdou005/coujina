<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Competition;
use App\LikeRecipe;
use App\Repositories\CompetitionRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{

    public function getRanking(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);
            $draw = $request->input('draw');
            $time = time();
            $page = $start / $length + 1;
            $competitions = Competition::where('start_at', '<=', $time)
                ->where('end_at', '>', $time)
                ->paginate($length, ['*'], $start, $page);
            $competitions->each(function(Competition $competition) {
                $competition->start_at = date("d-m-Y", $competition->start_at);
                $competition->end_at = date("d-m-Y", $competition->end_at);
                $competition->count_participate = $competition->recipes()->groupBy('user_id')->pluck('user_id')->count();
            });
            $response = [
                'draw' => $draw,
                "recordsTotal" => $competitions->total(),
                "recordsFiltered" => $competitions->total(),
                "data" => $competitions->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.ranking.ranking-layout-list');
    }

    public function getRankingByCompetition($competitionId){
        $competition = Competition::findOrFail($competitionId);
        $ranking = User::join('recipes', 'users.id', '=', 'recipes.user_id')
            ->where('recipes.competition_id', '=', $competition->id)
            ->rightJoin('like_recipe', 'recipes.id', '=', 'like_recipe.recipe_id')
            ->where('like_recipe.created_at', '>=', $competition->start_at)
            ->where('like_recipe.created_at', '<', $competition->end_at)
            ->groupBy('users.id')
            ->orderBy('count_like', 'desc')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.image', 'users.email', 'users.role', DB::raw('COUNT(like_recipe.id) as count_like'))->get();
        return response()->json($ranking, 200);
    }
}