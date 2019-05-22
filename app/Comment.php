<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Comment
 *
 * @property integer user_id
 * @property integer recipe_id
 * @property string comment
 *
 * @property User user
 * @property Recipe recipe
 *
 * @package App
 */
class Comment extends Model
{
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
