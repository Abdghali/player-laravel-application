<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const SEEN = '1';

    public const UNSEEN = '0';

    /** Mark As Seen */

    public function markAsSeen()
    {
        return $this->update([
            'status' => static::SEEN,
        ]);
    }

    /** Mark As UnSeen */

    public function markAsUnSeen()
    {
        return $this->update([
            'status' => static::UNSEEN,
        ]);
    }

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
