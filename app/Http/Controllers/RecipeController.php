<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Recipe;
use App\Repositories\RecipeRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class RecipeController extends Controller
{

    public function getRecipes(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $userId = $request->input('user_id', null);
        $user = auth()->user();
        if ($userId) {
            $user = User::findOrFail($userId);
        }
        $page = $start / $length + 1;
        $recipes = $user->recipes()->with(['tags', 'user', 'competition'])->withCount(['likes', 'comments'])->paginate($length, ['*'], $start, $page);
        $response = [
            'draw' => $draw,
            "recordsTotal" => $recipes->total(),
            "recordsFiltered" => $recipes->total(),
            "data" => $recipes->items()
        ];
        return response()->json($response, 200);
    }

    public function getRecipesForAdmin(Request $request)
    {
        if ($request->ajax()){
            $start = $request->get('start');
            $length = $request->get('length');
            $draw = $request->get('draw');
            $name = $request->input('name', null);
            $page = $start / $length + 1;
            $recipes = Recipe::with(['tags', 'user', 'competition'])
                ->withCount(['likes', 'comments']);
            if ($name){
                $recipes = $recipes->where('title', 'LIKE', '%'.$name.'%');
            }
            $recipes = $recipes->paginate($length, ['*'], $start, $page);
            $response = [
                'draw' => $draw,
                "recordsTotal" => $recipes->total(),
                "recordsFiltered" => $recipes->total(),
                "data" => $recipes->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.recipes.recipes-layout-list');
    }
    public function removeRecipe($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);
        $recipe->delete();
        return response()->json(['status' => 'success', 'message' => 'Recette supprimée avec succes'], 200);
    }

    public function createRecipe(RecipeRequest $request)
    {
        $title = $request->get('title');
        $desc = $request->get('desc_recipe');
        $image = $request->file('image_recipe');
        $tags = $request->get('tags');
        $ingredients = $request->input('ingredients', null);
        $path = null;
        if ($image) {
            $path = uploadFile($image, 'recipes', generateNewRandomString());
        }
        $userRepository = new UserRepository(auth()->user());
        $userRepository->createRecipe($title, $path, $desc, $tags, $ingredients);
        return response()->json(['status' => 'success', 'message' => 'Recette ajoutée avec succes'], 200);
    }

    public function updateRecipe($recipeId, RecipeRequest $request)
    {
        $recipe = Recipe::findOrFail($recipeId);
        $title = $request->get('title');
        $desc = $request->get('desc_recipe');
        $tags = $request->get('tags', []);
        $ingredients = $request->input('ingredients', null);
        $image = $request->file('image_recipe');
        $path = $recipe->image;
        if ($image) {
            $path = uploadFile($image, 'recipes', generateNewRandomString());
            if ($recipe->image && file_exists(public_path($recipe->image))) {
                unlink(public_path($recipe->image));
            }
        }
        $userRepository = new RecipeRepository($recipe);
        $userRepository->updateRecipe($title, $path, $desc, $tags, $ingredients);
        return response()->json(['status' => 'success', 'message' => 'Recette modifiée avec succes'], 200);
    }
}