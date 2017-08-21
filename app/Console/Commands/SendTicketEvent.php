<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\ReservationEvent;

class SendTicketEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ticket_event {seat} {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Tickets event';

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
        $seatId = $this->argument('seat');
        $reservationType = $this->argument('type');

        event(new ReservationEvent($seatId, $reservationType));
    }

}
