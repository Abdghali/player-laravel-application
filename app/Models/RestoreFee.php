<?php

namespace App\Models;

use App\Traits\ChangeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoreFee extends Model
{
    use HasFactory, ChangeStatus;

    protected $guarded = [];

    public const SEEN = '1';

    public const UNSEEN = '0';

    /**
     * Return unseen.
     *
     * @return integer
     */
    public static function unseenCount(): int
    {
        return static::where('status', static::UNSEEN)->count();
    }

    /** Relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
