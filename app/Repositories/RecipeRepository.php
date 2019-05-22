<?php

namespace App\Repositories;

use App\Recipe;

class RecipeRepository
{
    /**
     * @var Recipe
     */
    private $recipe;

    /**
     * RecipeRepository constructor.
     * @param Recipe $recipe
     */
    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * @param string $title
     * @param string $desc
     * @param array $tags
     * @param string $image
     * @param string @$ingredients
     * @param string @desc
     * @return Recipe $recipe
     */
    public function updateRecipe($title, $image, $desc, $tags = [], $ingredients): Recipe
    {
        $this->recipe->title = $title;
        $this->recipe->image = $image;
        $this->recipe->desc = $desc;
        $this->recipe->ingredients = $ingredients;
        $this->recipe->save();
        if (count($tags)) {
            $this->recipe->tags()->attach($tags);
        }
        return $this->recipe;
    }
}