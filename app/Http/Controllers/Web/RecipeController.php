<?php

namespace App\Http\Controllers\Web;

use App\Comment;
use App\Competition;
use App\Http\Controllers\Controller;
use App\LikeRecipe;
use App\Notification;
use App\Recipe;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    const COUNT_LIKE = 100;

    public function getRecipes(Request $request)
    {
       $tag = $request->input('tag', null);
       $name = $request->input('name', null);
        $recipes = Recipe::withCount(['likes', 'comments'])->with(['user', 'tags']);
        if ($name){
            $recipes = $recipes->where('title', 'LIKE', '%'.$name.'%');
        }
        if ($tag){
            $recipes = $recipes->whereHas('tags', function($tags) use($tag){
                $tags->where('tags.id', '=', $tag);
            });
        }
        $recipes = $recipes->orderBy('created_at', 'desc')->get();
        $user = null;
        if (Auth::check()) {
            $user = auth()->user();
            $recipes->each(function (Recipe $recipe) use ($user) {
                $recipe->is_Liked = $recipe->iLike()->count();
            });
        }
        if ($request->ajax()){
            return response()->json($recipes, 200);
        }
        $tags = Tag::all();
        return view('web.recipes', compact('recipes', 'tags'));
    }

    public function getRecipesParticipate($competitionId)
    {
        $user = auth()->user();
        $time = time();
        $recipesCurrentCompetitions = $user->recipes()->where(function ($query) use ($time) {
            $query->whereHas('competition', function ($connected) use ($time) {
                $connected->where('start_at', '<=', $time)->where('end_at', '>', $time);
            });
        })->pluck('id');
        $recipes = $user->recipes()
            ->where(function ($query) use ($recipesCurrentCompetitions, $competitionId) {
                $query->whereNotIn('id', $recipesCurrentCompetitions)
                    ->where('competition_id', '!=', $competitionId)
                    ->orWhereNull('competition_id');
            })
            ->with('competition')->get();
        return response()->json($recipes, 200);
    }

    public function participate($competitionId, $recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);
        $competition = Competition::findOrFail($competitionId);
        $recipe->competition_id = $competition->id;
        $recipe->save();
        return response()->json($recipe, 200);
    }

    public function findRecipe($recipeId, Request $request)
    {
        $recipe = Recipe::findOrFail($recipeId);
        if ($request->ajax()) {
            return response()->json($recipe, 200);
        }
        $recipe->count_likes = $recipe->likes()->count();
        $recipe->count_comments = $recipe->comments()->count();
        $recipe->user;
        $recipes = Recipe::orderBy('created_at', 'desc')->limit(10)->get();
        return view('web.recipe-view', compact('recipe', 'recipes'));
    }

    public function getCommentsByRecipeId($recipeId, Request $request)
    {
        $recipe = Recipe::findOrFail($recipeId);
        $comments = $recipe->comments()->with('user')->orderBy('created_at', 'asc')->limit(10)->get();
        $comments->each(function (Comment $comment) {
            $comment->created_date = $comment->created_at->format('m/d/Y h:m');
        });
        return response()->json($comments, 200);
    }

    public function createCommentByRecipe($recipeId, Request $request)
    {
        $user = auth()->user();
        $comment_desc = $request->input('comment');
        if ($comment_desc) {
            $recipe = Recipe::findOrFail($recipeId);
            $comment = new Comment();
            $comment->recipe_id = $recipe->id;
            $comment->user_id = $user->id;
            $comment->comment = $comment_desc;
            $comment->save();
            $comment->user;
            return response()->json($comment, 200);
        }
        return response()->json(['status' => 'error', 'message' => 'comment required'], 406);
    }

    public function likeRecipe($recipeId)
    {
        $user = auth()->user();
        $recipe = Recipe::findOrFail($recipeId);
        $isLiked = $recipe->iLike()->count();
        if ($isLiked) {
            return response()->json(['status' => 'error', 'message' => 'is liked'], 406);
        }
        if ($recipe->user->role === User::SUBSCRIBER) {
            $time = time();
            if ($recipe->competition && $recipe->competition->start_at <= $time && $recipe->competition->end_at > $time) {
                $competition = $recipe->competition;
                $userOfRecipe = $recipe->user;
                $countLikeCompetition = $userOfRecipe->recipes()
                    ->where('competition_id', '=', $competition->id)
                    ->join('like_recipe', 'recipes.id', '=', 'like_recipe.recipe_id')
                    ->where('like_recipe.created_at', '>=', $competition->start_at)
                    ->where('like_recipe.created_at', '<', $competition->end_at)
                    ->count();
                if ($countLikeCompetition >= self::COUNT_LIKE - 1) {
                    $userOfRecipe->role = User::LEADER;
                    $userOfRecipe->save();
                    $notification = new Notification();
                    $notification->user_id = $userOfRecipe->id;
                    $notification->message = 'Votre profil a été mis à jour';
                    $notification->save();
                }
            }
        }
        $likeRecipe = new LikeRecipe();
        $likeRecipe->recipe_id = $recipe->id;
        $likeRecipe->user_id = $user->id;
        $likeRecipe->save();
        return response()->json($likeRecipe, 200);
    }

    public function unLikeRecipe($recipeId)
    {
        $user = auth()->user();
        $recipe = Recipe::findOrFail($recipeId);
        $isLiked = $recipe->iLike()->count();
        if (!$isLiked) {
            return response()->json(['status' => 'error', 'message' => 'not liked'], 406);
        }
        $likeRecipe = LikeRecipe::where('user_id', '=', $user->id)
            ->where('recipe_id', '=', $recipe->id)->delete();
        return response()->json($likeRecipe, 200);
    }
}