<?php

namespace App\Http\Controllers;

use App\Sector;

class TicketsController extends Controller
{
    /**
     * Sector::class
     *
     * @var Sector
     */
    public $sector;

    /**
     * TicketsController constructor.
     */
    public function __construct()
    {
        $this->sector = new Sector;
    }

    /**
     * Show Tickets page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sectors = $this->sector
            ->with(['seats.reservation', 'seats.liteReservation'])
            ->get();

        return view('tickets', compact('sectors'));
    }
}
