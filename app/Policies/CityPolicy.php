<?php

namespace App\Policies;

use App\Models\City;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function view(Admin $admin, City $city)
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
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function update(Admin $admin, City $city)
    {
        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\City  $city
     * @return mixed
     */
    public function delete(Admin $admin, City $city)
    {
        return  $city->canDelete();
    }
}
