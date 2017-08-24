<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;
use Cache;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sectors = Cache::get('sectors');

        $reservation = $request->user()
            ->reservation()
            ->with('seat')
            ->first();

        return view('tickets', compact('sectors', 'reservation'));
    }
}
