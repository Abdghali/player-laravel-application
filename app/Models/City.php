<?php

namespace App\Models;

use App\Traits\CanDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    use HasFactory, CanDelete, \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];


    protected $relatedRelations = [
        'playgrounds',
        'users',
        'games'
    ];


    public static function getCitiesWithAllOption()
    {
        $cities =  DB::table('cities')->select(['id', 'name'])->pluck('name', 'id')->toArray();

        $cities[0] =  __('All Cities');

        ksort($cities);

        return $cities;
    }

    /** Relations */

    public function playgrounds()
    {
        return $this->hasMany(Playground::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function games()
    {
        return $this->hasManyDeep(Game::class, [Playground::class]);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
