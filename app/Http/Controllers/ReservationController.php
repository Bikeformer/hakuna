<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\LiteReservation;
use App\Reservation;
use Auth;


class ReservationController extends Controller
{
    /**
     * Reservation::class
     *
     * @var Reservation
     */
    public $reservation;
    public $liteReservation;

    const MESSAGE_OK = 'Выбранное место успешно забронировано';
    const MESSAGE_ERROR = 'Ошибка';
    const MESSAGE_DELETE = 'Удалено';
    const MESSAGE_REPEAT = 'Вы уже забронировали место';
    const MESSAGE_RESERVATION_ERROR = 'Выбранное место уже забронировано или находится в процессе бронирования';

    /**
     * ReservationController constructor.
     */
    public function __construct()
    {
        $this->reservation = new Reservation;
        $this->liteReservation = new LiteReservation;
    }

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
        $this->liteReservation->where('user_id', $userId)->delete();

        return response()->json(['message' => self::MESSAGE_OK]);
    }

    /**
     * Delete reservation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $user_id = Auth::user()->id;
        $reservation = $this->reservation->where('user_id', $user_id)->first();
        if($reservation) $reservation->delete();

        return $reservation ?
            response()->json(['message' => self::MESSAGE_DELETE]):
            response()->json(['message' => self::MESSAGE_ERROR]);
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
                self::MESSAGE_REPEAT :
                self::MESSAGE_RESERVATION_ERROR;
        } else {
            return true;
        }
    }

}
