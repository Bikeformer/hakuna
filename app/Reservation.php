<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ReservationEvent;

class Reservation extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'seat_id',
        'user_id',
    ];

    public static function boot()
    {
        static::saved(function ($instance) {
            event(new ReservationEvent($instance->seat_id, 0));
        });

        parent::boot();
    }

}
