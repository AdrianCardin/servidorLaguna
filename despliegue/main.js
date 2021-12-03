$(buscarDatos());
function buscarDatos(consulta){

    $.ajax({
        url: "buscar.php",
        type: "POST",
        dataType: "html",
        data: {consulta:consulta},

        success: function (response) {
            $("#datos").html(response);
        }
    });
}