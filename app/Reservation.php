<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ReservationEvent;
use Artisan;

class Reservation extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'seat_id',
        'user_id',
    ];

    /**
     * Get Seat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public static function boot()
    {
        static::saved(function ($instance) {
            event(new ReservationEvent($instance->seat_id, 0));
            Artisan::call('caching-tickets');
        });

        static::deleted(function ($instance) {
            event(new ReservationEvent($instance->seat_id, 2));
            Artisan::call('caching-tickets');
        });

        parent::boot();
    }

}
