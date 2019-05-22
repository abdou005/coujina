<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property string first_name
 * @property string last_name
 * @property integer role
 * @property string image
 * @property string email
 * @property string tel
 * @property string address
 * @property string desc
 * @property string password
 *
 * @property array recipes
 *
 * @package App
 */
class User extends Authenticatable
{
    CONST ADMIN = 1, VISITOR = 2, SUBSCRIBER = 3, LEADER = 4;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'image', 'email', 'password', 'tel', 'address', 'desc', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getDateFormat()
    {
        return 'U';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeRecipe::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function myFollowing()
    {
        return $this->hasMany(Friend::class, 'from_id');
    }

    public function myFollowers()
    {
        return $this->hasMany(Friend::class, 'to_id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

}
