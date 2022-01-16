<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Application;
use App\Models\Admin;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Application  $application
     * @return mixed
     */
    public function view(Admin $admin, Application $application)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Application  $application
     * @return mixed
     */
    public function update(Admin $admin, Application $application)
    {
        return true;
    }
    
    public function addApplication(Admin $admin)
    {
        return false;
    }
}
