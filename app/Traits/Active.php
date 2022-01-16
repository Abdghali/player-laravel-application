<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Active
{
    /**
     * Select only active entities.
     * 
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', ACTIVE);
    }
}
