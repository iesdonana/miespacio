
function indicarNotificaciones(num_notificaciones, url_send) {

    let enlace = $("a[data-target='#modal_notificaciones']");
    let num = $(`<span>${num_notificaciones}</span>`);

    if (num_notificaciones > 0) {

        enlace.addClass('aviso');
        num.addClass('badge');
        enlace.append(num);

        eventoModal(url_send);

    } else {
        enlace.removeClass('aviso');
        enlace.find('.badge').remove();
    }

}

function eventoModal(url_send) {
    $('#modal_notificaciones').on('show.bs.modal', function() {
        sendAjax(url_send, 'GET', {}, function(data) {
            indicarNotificaciones(data);
        })
    })
}


function iniciarGestionVentanas(p_width, p_height, p_top) {

    $('#ventana_estilos').on('click', function() {
        let v_left = (screen.width/2) - (p_width/2);
        let v_right = (screen.height/2) - (p_height/2);

        let ventana = window.open(
            "../html/colores.html",
            'Colores',
            `width=${p_width}px, height=${p_height}px, left=${v_left},
                right=${v_right}, top=${p_top}px`
        );
    })
}

function establecerEstilo() {
    let color = localStorage.getItem('estilo');

    $("div[id='tablero']").css('backgroundColor', color);
    $("div[id='tablero']").css('borderColor', color);

    $("div[id='tablero']").parent().css('borderColor', color);
}
