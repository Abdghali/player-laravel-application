<?php

namespace App\Models;

use App\Traits\CanDelete;
use App\Traits\ShearedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerType extends Model
{
    use HasFactory, CanDelete;

    protected $guarded = [];
    
    protected $relatedRelations = [
        'users'
    ];

    /** Relations */

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
