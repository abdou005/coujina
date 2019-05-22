<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 * @property string title
 * @property string desc
 * @property integer image
 * @property string ingredients
 * @property integer user_id
 * @property string|null competition_id
 *
 * @property User user
 * @property  Competition competition
 * @property array tags
 * @package App
 */
class Recipe extends Model
{

    public function getDateFormat()
    {
        return 'U';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeRecipe::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function iLike(){
        return $this->hasMany(LikeRecipe::class)->where('user_id', '=', auth()->user()->id);
    }
}
