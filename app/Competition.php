<?php

namespace App;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Competition
 *
 * @property integer type
 * @property string name
 * @property string address
 * @property string desc
 * @property string image
 * @property Date start_at
 * @property Date end_at
 *
 * @package App
 */
class Competition extends Model
{

    public function getDateFormat()
    {
        return 'U';
    }

    CONST AMATEUR = 1, PROFESSIONAL = 2;

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
