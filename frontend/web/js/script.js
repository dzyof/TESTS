window.onload = function() {

    var _Seconds = $('.seconds').text(),
        int;
    int = setInterval(function() { // запускаем интервал
        if (_Seconds > 0) {
            _Seconds--; // вычитаем 1
            $('.seconds').text(_Seconds); // выводим получившееся значение в блок
        } else {
            clearInterval(int); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
            // window.location.href = "/";
            // $('#autoSend').click();
            $('#myModal').modal('show');
        }
    }, 1000);
    $('#myModal').on('hidden.bs.modal', function () {
        document.location.href="/";
    });

    $( function() {
        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    } );


    $( function() {
        $( "#accordion" )
            .accordion({
                header: "> div > h3"
            })
            .sortable({
                axis: "y",
                handle: "h3",
                stop: function( event, ui ) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children( "h3" ).triggerHandler( "focusout" );

                    // Refresh accordion to handle new order
                    $( this ).accordion( "refresh" );
                }
            });
    } );


}


