<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    
    public function isAdmin(User $user){
        if($user->level == 'admin') {
            return true;
        }
        return false;
    }

    public function isWriter(User $user){
        if($user->level == 'writer') {
            return true;
        }
        return false;
    }

    public function isCustomer(User $user){
        if($user->level == 'customer') {
            return true;
        }
        return false;
    }
}
