<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LikeRecipe
 * @property integer user_id
 * @property integer recipe_id
 *
 * @property User user
 * @property Recipe recipe
 *
 * @package App
 */
class LikeRecipe extends Model
{
    protected $table = 'like_recipe';

    public function getDateFormat()
    {
        return 'U';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
