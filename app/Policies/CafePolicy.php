<?php

namespace App\Policies;

use App\Models\Cafe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CafePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cafe $cafe): bool
    {
        return $user->id === $cafe->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cafe $cafe): bool
    {
        return $user->id === $cafe->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cafe $cafe): bool
    {
        return $user->id === $cafe->user_id;
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function switch(User $user, Cafe $cafe): bool
    {
        return $user->id === $cafe->user_id;
    }
}
