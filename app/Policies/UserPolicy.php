<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin    
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(Admin $admin, User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(Admin $admin, User $model)
    {
        return true;
    }

    public function addGame(Admin $admin)
    {
        return false;
    }
}
