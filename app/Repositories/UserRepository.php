<?php

namespace App\Repositories;

use App\Recipe;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * @param string|null $name
     * @param bool $pagination
     * @param integer $start
     * @param integer $length
     * @return LengthAwarePaginator|Collection
     */
    public static function searchUsersByFilter($name = null, $pagination = false, $start = 0, $length = 10){
        $users = User::withCount(['recipes'])->orderBy('created_at', 'desc')
            ->where('role', '!=', User::ADMIN);
        if ($name) {
            $users = $users->where('first_name','like','%'.$name.'%')
                ->orWhere('last_name','like','%'.$name.'%')
                ->orWhere('email','like','%'.$name.'%');
        }
        if($pagination){
            $page=$start/$length+1;
            $users = $users->paginate($length, ['*'], $start, $page);
        } else {
            $users = $users->get();
        }
        return $users;
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
    public function createRecipe($title, $image, $desc, $tags = [], $ingredients): Recipe
    {
        $recipe = new Recipe();
        $recipe->title = $title;
        $recipe->image = $image;
        $recipe->desc = $desc;
        $recipe->ingredients = $ingredients;
        $recipe->user_id = $this->user->id;
        $recipe->save();
        if (count($tags)) {
            $recipe->tags()->sync($tags);
        }
        return $recipe;
    }


    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $image
     * @param string $email
     * @param string $address
     * @param string @tel
     * @param string @desc
     * @return User
     */
    public function updateUser($firstName, $lastName, $email, $image, $address, $tel, $desc)
    {
        $this->user->first_name = $firstName;
        $this->user->last_name = $lastName;
        $this->user->image = $image;
        $this->user->email = $email;
        $this->user->address = $address;
        $this->user->tel = $tel;
        $this->user->desc = $desc;
        $this->user->save();
        return $this->user;
    }
}