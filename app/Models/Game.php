<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        static::deleting(function (Game $game) {
            $game->users()->sync([]);
        });
    }

    public static $sortBy = 'start';

    public const RUNNNIG = '1';

    public const WAITNIG = '0';

    protected $casts = [
        'start' => 'datetime',
    ];

    /** Relations */

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function playground(): BelongsTo
    {
        return $this->belongsTo(Playground::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->start)->format('Y-m-d');
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->start)->format('g:i A');
    }
}
