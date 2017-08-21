@extends('layouts.app')

@section('content')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

    {{--{{ dump($seats->toArray()) }}--}}
    <style type="text/css">
        #buy {
            position: fixed;
            bottom: 40px;
            left: 40px;
            z-index: 9999;
        }
    </style>

    <div id="buy" class="scroll">
        <input type="button" id="btn-buy" class="btn btn-success" value="Выберите место в таблице">
    </div>

    <div class="container">
        <div class="row">

            @include('include.ticket_info')

            @foreach($sectors as $sector)
                <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Сктор: {{ $sector->id }}</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th class="info">Ряд</th>
                                    <th class="info" colspan="{{ env('COUNT_SEATS') }}">Место</th>
                                </tr>
                            </thead>

                            @foreach($sector->seats as $seat)
                                @if($seat->seat_number === 1)
                                    <tr>
                                        <td class="info"><b>{{ $seat->line_number }}</b></td>
                                @endif
                                        <td @if($seat->reservation) class="danger" @elseif($seat->liteReservation) class="warning" @else class="success seat" @endif
                                        data-id="{{ $seat->id }}" data-line="{{ $seat->line_number }}" data-sector="{{ $sector->id }}">
                                            {{ $seat->seat_number }}
                                        </td>
                                @if($seat->seat_number === env('COUNT_SEATS'))
                                    </tr>
                                @endif

                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
