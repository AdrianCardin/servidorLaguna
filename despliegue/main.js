$(buscarDatos());
function buscarDatos(consulta){

    $.ajax({
        url: "buscar.php",
        type: "POST",
        dataType: "html",
        data: {consulta:consulta},
    });

    done( function (response) {
        $("#datos").html(response);
    })
}

$(document).on('keyup', '#cajaBusqueda', function(){
    var valor=$(this).val();
    if (valor != "") {
        buscarDatos(valor);
    } else{
        buscarDatos();
    }
})