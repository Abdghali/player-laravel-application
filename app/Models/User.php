<?php

namespace App\Models;

use App\Traits\ChangeStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasImage;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasImage, ChangeStatus;


    public static function booted()
    {
        static::updated(function (User $user) {
            if (!$user->status) {
                $user->tokens()->delete();
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'number',
        'player_type_id',
        'city_id',
        'status',
        'notifications_settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Relations */

    public function playerType()
    {
        return $this->belongsTo(PlayerType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function restoreFee()
    {
        return $this->hasOne(RestoreFee::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class)->withTimestamps();
    }
}
