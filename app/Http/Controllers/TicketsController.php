<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use Artisan;

class TicketsController extends Controller
{

    /**
     * Show Tickets page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sectors = Cache::get('sectors');

        if(!$sectors) {
            Artisan::call('caching-tickets');
            $sectors = Cache::get('sectors');
        }

        $reservation = $request->user()
            ->reservation()
            ->with('seat')
            ->first();

        return view('tickets', compact('sectors', 'reservation'));
    }
}
