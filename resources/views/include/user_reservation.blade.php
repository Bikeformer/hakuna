<div class="col-md-8 col-md-offset-2" id="user-reservation">
    <div class="panel panel-default">
        <div class="panel-heading">Ваш заказ</div>
        <div class="panel-body">
            <p>Ваше место <b>{{ $reservation->seat->seat_number }}</b>, ряд <b>{{ $reservation->seat->line_number }}</b>, сектор <b>{{ $reservation->seat->sector_id }}</b>. Подсвечивается голубым цветом</p>
            <p><button type="button" id="delete-reservation" class="btn btn-danger">Удалить</button></p>
        </div>
    </div>
</div>