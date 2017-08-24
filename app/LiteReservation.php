<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ReservationEvent;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiteReservation extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'seat_id',
        'user_id',
        'end_time',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dates = ['end_date', 'deleted_at'];

    public static function boot()
    {
        static::created(function ($instance) {
            event(new ReservationEvent($instance->seat_id, 1));
        });

        static::deleted(function ($instance) {
            event(new ReservationEvent($instance->seat_id, 2));
        });

        parent::boot();
    }

}
