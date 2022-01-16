<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Message;
use App\Models\Admin;

class MessagePolicy
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
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function view(Admin $admin, Message $message)
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
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function update(Admin $admin, Message $message)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function delete(Admin $admin, Message $message)
    {
        return true;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  *
    //  * @param  \App\Models\Admin  $admin
    //  * @param  \App\Models\Message  $message
    //  * @return mixed
    //  */
    // public function restore(Admin $admin, Message $message)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\Admin  $admin
    //  * @param  \App\Models\Message  $message
    //  * @return mixed
    //  */
    // public function forceDelete(Admin $admin, Message $message)
    // {
    //     //
    // }
}
