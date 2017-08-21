<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Reservation;

class ReservationController extends Controller
{
    /**
     * Reservation::class
     *
     * @var Reservation
     */
    public $reservation;

    /**
     * ReservationController constructor.
     */
    public function __construct()
    {
        $this->reservation = new Reservation;
    }

    /**
     * Response Message
     *
     * @var array
     */
    private $responseMessage = [
        'Выбранное место успешно забронировано',
        'Вы уже забронировали место',
        'Выбранное место уже забронировано или находится в процессе бронирования',
    ];

    /**
     * Store Reservation seat
     *
     * @param ReservationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReservationRequest $request)
    {
        $userId = $request->user()->id;

        $checkReservation = $this->checkReservation($userId);

        if($checkReservation !== true) return response()->json(['message' => $checkReservation]);

        $this->reservation->user_id = $userId;
        $this->reservation->seat_id = $request->seat_id;
        $this->reservation->save();

        return response()->json(['message' => $this->responseMessage[0]]);
    }

    /**
     * Check reservation
     *
     * @param $userId
     * @return bool|mixed
     */
    private function checkReservation($userId)
    {
        $reservation = $this->reservation
            ->where('user_id', $userId)
            ->orWhere('seat_id', request('seat_id'))
            ->first();

        if(!empty($reservation)) {
            return $reservation->user_id === $userId ?
                $this->responseMessage[1]:
                $this->responseMessage[2];
        }else{
            return true;
        }
    }

}
