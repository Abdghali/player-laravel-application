<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Playground;

class PlaygroundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Playground  $playground
     * @return mixed
     */
    public function view(Admin $admin, Playground $playground)
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
     * @param  \App\Models\Playground  $playground
     * @return mixed
     */
    public function update(Admin $admin, Playground $playground)
    {
        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Playground  $playground
     * @return mixed
     */
    public function delete(Admin $admin, Playground $playground)
    {
        return $playground->canDelete();
    }

}
