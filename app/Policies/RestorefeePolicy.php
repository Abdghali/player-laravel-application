<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\RestoreFee;
use App\Models\Admin;

class RestorefeePolicy
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
     * @param  \App\Models\RestoreFee  $restoreFee
     * @return mixed
     */
    public function view(Admin $admin, RestoreFee $restoreFee)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RestoreFee  $restoreFee
     * @return mixed
     */
    public function update(Admin $admin, RestoreFee $restoreFee)
    {
        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RestoreFee  $restoreFee
     * @return mixed
     */
    public function delete(Admin $admin, RestoreFee $restoreFee)
    {
        return true;
    }

        
    public function addRestorefee(Admin $admin)
    {
        return false;
    }

}
