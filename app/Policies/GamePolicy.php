<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Game;
use App\Models\Admin;
use App\Models\User;

class GamePolicy
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
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return mixed
     */
    public function view(Admin $admin, Game $game)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return mixed
     */
    public function update(Admin $admin, Game $game)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return mixed
     */
    public function delete(Admin $admin, Game $game)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return mixed
     */
    public function restore(Admin $admin, Game $game)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return mixed
     */
    public function forceDelete(Admin $admin, Game $game)
    {
        return true;
    }

    public function attachAnyUser(Admin $admin, Game $game)
    {
        return false;
    }
}
