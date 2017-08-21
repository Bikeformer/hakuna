<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get Seats
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

}
