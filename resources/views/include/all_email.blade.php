{{-- на скорую руку, для удобства авторизации --}}

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <b>Email</b>:
            @foreach(\App\User::pluck('email') as $email)
                {{ $email }}
                @if(!$loop->last),@endif
            @endforeach
            <br><b>Pass</b>: 1234
        </div>
    </div>
</div>