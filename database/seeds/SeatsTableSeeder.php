<?php

use Illuminate\Database\Seeder;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count_sector = App\Sector::count();
        $count_line = env('COUNT_LINES');
        $count_seat = env('COUNT_SEATS');

        $seats = [];

        for($j = 1; $j <= $count_sector; $j++) {
            for($l = 1; $l <= $count_line; $l++) {
                for($s = 1; $s <= $count_seat; $s++) {

                    $seats[] = [
                        'sector_id' => $j,
                        'line_number' => $l,
                        'seat_number' => $s,
                    ];

                }
            }
        }

        DB::table('seats')->insert($seats);
    }
}


//<?php
//
//use Illuminate\Database\Seeder;
//
//class SeatsTableSeeder extends Seeder
//{
//    /**
//     * Run the database seeds.
//     *
//     * @return void
//     */
//    public function run()
//    {
//        $sector_count = App\Sector::count();
//        $seat_count = 4000;
//        $seats = [];
//
//        for($i = 0; $i < $seat_count; $i++) {
//            $seats[$i]['seat_number'] = $i;
//
//            $line_count = rand(10, 20);
//
//            for($l = 1; $l <= $line_count; $l++) {
//                $seats[$i]['line_number'] = $l;
//
//                for($s = 1; $s <= $sector_count; $s++) {
//                    $seats[$i]['sector_id'] = $s;
//                }
//            }
//        }
//
//        DB::table('seats')->insert($seats);
//    }
//}

//---


//
//use Illuminate\Database\Seeder;
//
//class SeatsTableSeeder extends Seeder
//{
//    /**
//     * Run the database seeds.
//     *
//     * @return void
//     */
//    public function run()
//    {
//        $sector_count = App\Sector::count();
//        $seat_count = 4000;
//        $line_count = 20;
//        $seats = [];
//
//        for($i = 0; $i < $seat_count; $i++) {
////            $seats[$i]['seat_number'] = $i;
//
//            for($l = 1; $l <= $line_count; $l++) {
////                $seats[$i]['line_number'] = $l;
//
//                for($s = 1; $s <= $sector_count; $s++) {
//                    $seats[$i]['seat_number'] = $i + 1;
//                    $seats[$i]['line_number'] = $l;
//                    $seats[$i]['sector_id'] = $s;
//                }
//            }
//        }
//
//        DB::table('seats')->insert($seats);
//    }
//}
