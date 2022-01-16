<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\PlayerType;
use App\Models\Admin;

class PlayertypePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\PlayerType  $playerType
     * @return mixed
     */
    public function view(Admin $admin, PlayerType $playerType)
    {
        return true;
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\PlayerType  $playerType
     * @return mixed
     */
    public function update(Admin $admin, PlayerType $playerType)
    {
        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\PlayerType  $playerType
     * @return mixed
     */
    public function delete(Admin $admin, PlayerType $playerType)
    {
        return $playerType->canDelete();
    }
}
