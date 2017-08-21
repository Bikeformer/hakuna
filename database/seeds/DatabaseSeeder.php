<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
//        $this->call(LiteReservationTableSeeder::class);
    }
}
