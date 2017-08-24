<?php

namespace App\Console\Commands;

use App\Sector;
use Illuminate\Console\Command;
use Cache;

class CachingTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'caching-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caching tickets';

    /**
     * Sector::class
     *
     * @var Sector
     */
    public $sector;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sector = new Sector;
        parent::__construct();
    }

    /**
     * Caching sectors.
     *
     * @return mixed
     */
    public function handle()
    {
        $sectors = $this->sector
            ->with(['seats.reservation', 'seats.liteReservation'])
            ->get();

        Cache::forever('sectors', $sectors);
    }

}
