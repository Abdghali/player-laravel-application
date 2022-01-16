<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function whatsapp()
    {
        return Setting::find(1)->value;
    }

    public static function twitter()
    {
        return Setting::find(2)->value;
    }

    public static function aboutUs()
    {
        return  Setting::find(3)->value;
    }

    public static function terms()
    {
        return Setting::find(4)->value;
    }
}
