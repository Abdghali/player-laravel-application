<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        static::creating(function ($message) {
            $message->admin_id = admin()->id;

            if ($message->city_id == 0) {
                $message->city_id = null;
            }
        });
        static::created(function ($message) {
            fcm()
                ->to(
                    DB::table('users')
                        ->where('notifications_settings', ACTIVE)->distinct()
                        ->when(
                            $message->city_id,
                            fn ($query) =>
                            $query->where('city_id', $message->city_id)
                        )
                        ->get('token')->pluck('token')->toArray()
                ) // $recipients must an array
                ->priority('high')
                ->timeToLive(0)
                ->notification([
                    'title' => $message->title,
                    'body' => $message->content,
                ])
                ->send();
        });
    }

    /** Relations */

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
