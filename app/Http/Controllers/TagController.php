<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{

    public function getTags(Request $request)
    {
        $name = $request->get('q');
        $isEditRecipe = $request->get('is_edit_recipe');
        $tagsRecipe = [];
        if ($isEditRecipe != '0') {
            $tagsRecipe = Recipe::find($isEditRecipe)->tags()->get()->pluck('id')->toArray();
        }
        $genderLabel = null;
        $incompleteResults = true;
        $tags = Tag::where('name', 'LIKE', '%' . $name . '%');
        if (count($tagsRecipe)) {
            $tags = $tags->whereNotIn('id', $tagsRecipe);
        }
        $tags = $tags->paginate(10);
        $tagsAr = $tags->toArray();
        if ($tagsAr['next_page_url'] == null) {
            $incompleteResults = false;
        }
        $results = [
            "total_count" => $tagsAr['total'],
            "incomplete_results" => $incompleteResults,
            'items' => $this->transformData($tags)
        ];
        return response()->json($results, 200);
    }

    private function transformData($tags)
    {
        $data = [];
        foreach ($tags as $tag) {
            array_push($data, ['id' => $tag->id, 'text' => $tag->name]);
        }
        return ($data);
    }
}