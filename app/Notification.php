<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function getDateFormat()
    {
        return 'U';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
