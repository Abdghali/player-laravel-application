<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Setting  $setting
     * @return mixed
     */
    public function view(Admin $admin, Setting $setting)
    {
        return true;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Setting  $setting
     * @return mixed
     */
    public function update(Admin $admin, Setting $setting)
    {
        return true;
    }
}
