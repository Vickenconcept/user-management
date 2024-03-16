<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user)
    {
        // return $user->name; 
        return $user->role == 'admin'; 
    }
}
