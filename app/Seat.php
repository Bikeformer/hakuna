<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Seat extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'sector_id',
        'line_number',
        'seat_number',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    /**
     * Get Lite Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function liteReservation()
    {
        return $this->hasOne(LiteReservation::class)->where('end_time', '>', Carbon::now());
    }

}
