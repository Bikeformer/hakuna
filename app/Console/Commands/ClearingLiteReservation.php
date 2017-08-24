<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class ClearingLiteReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearing-lite-reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing Lite Reservation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('lite_reservations')
            ->whereNotNull('deleted_at')
            ->orWhere('end_time', '>', Carbon::now())
            ->delete();

        \Log::info('end cron\artisan delete lite reservation');
    }

}
