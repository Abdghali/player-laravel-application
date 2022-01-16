<?php

namespace App\Models;

use App\Traits\CanDelete;
use App\Traits\ChangeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playground extends Model
{
    use HasFactory, ChangeStatus, CanDelete;

    protected $guarded = [];

    protected $relatedRelations = [
        'games'
    ];


    public static function booted()
    {
        static::created(function (Playground $playground) {
            $playground->setLatLng();
        });

        static::updated(function (Playground $playground) {
            $playground->setLatLng();
        });
    }


    public function setLatLng()
    {
        static::withoutEvents(function () {
            $this->forceFill([
                'lat' => json_decode($this->location)->latlng->lat ?? null,
                'lng' => json_decode($this->location)->latlng->lng ?? null
            ])->save();
        });
    }

    /** Relations */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
