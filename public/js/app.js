Pusher.logToConsole = false;

var pusher = new Pusher('f5ba963d113eaa683023', {
    encrypted: true
});

var channel = pusher.subscribe('public-reservation');
channel.bind('reservation', function(data) {
    var class_name = '';
    if(data.reservationType == 0) {
        class_name = 'danger';
    }else if(data.reservationType == 1) {
        class_name = 'warning';
    }else if(data.reservationType == 2) {
        class_name = 'success seat';
    }

    console.log(data.seatId  +'  |  '+ class_name + '  |  '+ data.reservationType);

    $('[data-id="' + data.seatId + '"]').removeClass().addClass(class_name);

});

localStorage["seat_id"] = 0;

$(document).on("click", '.seat', function() {
    workForClass($(this));

    var seat_id = $(this).data('id');
    var seat_number = $(this).text();
    var line_number = $(this).data('line');
    var sector_id = $(this).data('sector');

    var btn_text = 'Предварительная бронь места ' + seat_number + ', ряд: ' + line_number + ', сектор: ' + sector_id + ', нажмите что бы купить';
    $('#btn-buy').val(btn_text).data('id', seat_id);

    var data = {
        'seat_id':seat_id,
        'die_seat_id':localStorage["seat_id"]
    };

    $.ajax({
        type: "POST",
        url: "lite-reservation",
        data: data,
        success: function(data) {
            // console.log(data);
        }
    });

    localStorage["seat_id"] = seat_id;
});

function workForClass(e) {
    $('.active').addClass("success");
    $('.row').removeClass("active");
    e.removeClass("success");
    e.addClass("active");
}

$("#btn-buy").on( "click", function() {
    if (!confirm("Сделать заказ?")) return false;

    var seat_id = $(this).data('id');
    if(!seat_id) return false;

    var data = {
        seat_id: seat_id
    };

    $.ajax({
        type: "POST",
        url: "reservation",
        data: data,
        success: function( data ) {
            alert(data.message);
        }
    });
});

$("#delete-reservation").on( "click", function() {
    if (!confirm("Удалить?")) return false;
    $('#user-reservation').remove();

    $.ajax({
        type: "DELETE",
        url: "reservation",
        success: function( data ) {
            alert(data.message);
        }
    });
});
