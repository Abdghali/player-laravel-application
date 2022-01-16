<?php

namespace App\Traits;

trait CanDelete
{

    public function canDelete()
    {
        foreach ($this->relatedRelations as $value) {

            if (static::$value()->count()) {
                return false;
            }
        }
        return true;
    }
}
