<?php

/**
 * Get the cuurent loggin user.
 *
 * @return App\Models\User
 */
function user()
{
    return auth()->user();
}

/**
 * Get the cuurent loggin admin.
 *
 * @return App\Models\Admin
 */
function admin()
{
    return auth('admin')->user();
}
