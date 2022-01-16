<?php

namespace App\Traits;

trait ChangeStatus
{

    public function deactivate()
    {
        $this->update([
            'status' => INACTIVE
        ]);
    }

    public function activate()
    {
        $this->update([
            'status' => ACTIVE
        ]);
    }
}
