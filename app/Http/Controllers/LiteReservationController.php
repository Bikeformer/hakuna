<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiteReservationRequest;
use Carbon\Carbon;
use App\LiteReservation;
use Illuminate\Http\Request;

class LiteReservationController extends Controller
{

    /**
     * LiteReservation::class
     *
     * @var LiteReservation
     */
    public $liteReservation;

    /**
     * LiteReservationController constructor.
     */
    public function __construct()
    {
        $this->liteReservation = new LiteReservation;
    }

    /**
     * Store Lite Reservation
     *
     * @param LiteReservationRequest $request
     * @return int
     */
    public function store(LiteReservationRequest $request)
    {
        $userId = $request->user()->id;
        $this->destroy($userId);

        $this->checkReservation($userId, $request);

        $this->liteReservation->user_id = $userId;
        $this->liteReservation->seat_id = $request->seat_id;
        $this->liteReservation->end_time = Carbon::now()->addMinutes(env('RESERVATION_MINUTES'));
        $this->liteReservation->save();
        exit;
    }

    /**
     * Destroy Lite Reservation by UserId
     *
     * @param $user_id
     */
    private function destroy($user_id)
    {
        $liteReservation = $this->liteReservation->where('user_id', $user_id)->first();
        if($liteReservation) $liteReservation->delete();
    }

    /**
     * Check Reservation
     *
     * @param $userId
     * @param Request $request
     * @return bool
     */
    private function checkReservation($userId, Request $request)
    {
        $reservation = $this->liteReservation
            ->where('seat_id', $request->seat_id)
            ->orWhere('user_id', $userId)
            ->first();

        if(empty($reservation)) {
            return true;
        } elseif($reservation->end_date > Carbon::now()) {
            $reservation->delete();
            return $this->checkReservation($userId, $request);
        }

        exit;
    }

}
