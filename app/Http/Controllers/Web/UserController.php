<?php

namespace App\Http\Controllers\Web;
use App\Competition;
use App\Http\Controllers\Controller;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::whereIn('role', [User::LEADER, User::SUBSCRIBER])->limit(50)->get();
        return view('web.users', compact('users'));
    }

    public function changeRole(){
        $user = auth()->user();
        if ($user->role === User::VISITOR){
            $user->role = User::SUBSCRIBER;
            $user->save();
        }
        return redirect('profile');
    }
}
