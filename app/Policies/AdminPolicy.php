<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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
        return $admin->isSuper();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $adminResource
     * @return mixed
     */
    public function view(Admin $admin, Admin $adminResource)
    {
        return $admin->isSuper();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->isSuper();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $adminResource
     * @return mixed
     */
    public function update(Admin $admin, Admin $adminResource)
    {
        return $admin->isSuper();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $adminResource
     * @return mixed
     */
    public function delete(Admin $admin, Admin $adminResource)
    {
        return $admin->isSuper();
    }

    public function addMessage(Admin $admin)
    {
        return false;
    }

}
