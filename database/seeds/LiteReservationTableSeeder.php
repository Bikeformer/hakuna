<?php

use Illuminate\Database\Seeder;

class LiteReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lite_reservations')->insert([
            'seat_id' => 1,
            'user_id' => 1,
            'end_date' => \Carbon\Carbon::now()->addMinutes(env('RESERVATION_MINUTES')),
        ]);

    }
}
