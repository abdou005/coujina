<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @property string name
 *
 * @property array recipes
 *
 * @package App
 */
class Tag extends Model
{

    public function getDateFormat()
    {
        return 'U';
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withTimestamps();
    }
}
