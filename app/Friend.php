<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Friend
 * @property integer from_id
 * @property integer to_id
 *
 * @property User userForm
 * @property User userTo
 *
 * @package App
 */
class Friend extends Model
{
    public function getDateFormat()
    {
        return 'U';
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
