loadColas();
loadIngredientes();
loadHistoric();
loadRecetas();
loadHistorial();

prepararPedidos();

setInterval(prepararPedidos, 300000);

$('#pedir').click(function (){
    Swal.fire({
        title: 'Se esta procesando la solicitud',
        icon: 'warning',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false
    });
    Swal.showLoading();

    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/pedir", {cantidad: $('#cantidad').val()})
    .done(function( data ) {
        let msj = `Hola, recibimos el pedido de ${data.encolados} ${data.encolados > 1 ? 'platos' : 'plato'}, 
        vamos a prepararlos rapidamente.`;
        let icon = 'success';

        Swal.fire({
            title: 'Finalizado',
            text: msj,
            icon: icon,
            confirmButtonText: 'Ok'
        });
        
        loadColas();
        loadHistoric();
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al realizar la solicitud',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
});

function loadColas () {
    $('#cola-pedidos').html('Estamos actualizando los datos.');
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/colas")
    .done(function( data ) {
       $('#cola-pedidos').html(data);
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la cola de pedidos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}

function loadIngredientes () {
    $('#ingredients').html('Estamos actualizando los datos');
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/ingredientes")
    .done(function( data ) {
       $('#ingredients').html(data);
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la bodega de alimentos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}

function loadHistoric () {
    $('#historico-pedidos').html('Estamos actualizando los datos.');
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/historico")
    .done(function( data ) {
       $('#historico-pedidos').html(data);
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la bodega de alimentos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}

function loadRecetas () {
    $('#recetas').html('Estamos cargando los datos.');
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/recetas")
    .done(function( data ) {
       $('#recetas').html(data);
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la bodega de alimentos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}

function loadHistorial () {
    $('#historial-compras').html('Estamos actualizando los datos.');
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/historial")
    .done(function( data ) {
       $('#historial-compras').html(data);
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la bodega de alimentos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}

function prepararPedidos () {
    $.post(sessionStorage.getItem('baseUrl') + "/api/comedor/preparar")
    .done(function( data ) {
        if (data.preparados > 0) {
            loadColas();
            loadIngredientes();
            loadHistoric();
            loadHistorial();

            let msj = `Hola, se han preparado ${data.preparados} ${data.preparados > 0 ? 'platos' : 'plato'}.`;
            let icon = 'success';

            Swal.fire({
                title: 'Finalizado',
                text: msj,
                icon: icon,
                confirmButtonText: 'Ok'
            });
        }
    }).fail(function (){
        Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al mostrar la bodega de alimentos',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    });
}