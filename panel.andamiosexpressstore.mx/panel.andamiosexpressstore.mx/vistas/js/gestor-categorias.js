// $.ajax({
//     url: "ajax/tablaCategorias.ajax.php",
//     success: function(respuesta) {
//         console.log("respuesta", respuesta);
//     }

// })

$('.tablaCategorias').DataTable({
    "ajax": "ajax/tablaCategorias.ajax.php",
    "defederRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
});
/**ACTIVAR CATEGORIA */
$(".tablaCategorias tbody").on("click", ".btnActivar", function() {
        var idCategoria = $(this).attr("idCategoria");
        var estadoCategoria = $(this).attr("estadoCategoria");

        var datos = new FormData();
        datos.append("activarId", idCategoria);
        datos.append("activarCategoria", estadoCategoria);

        $.ajax({
            url: "ajax/categorias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                console.log("respuesta", respuesta);
            }
        });

        if (estadoCategoria == 0) {

            $(this).removeClass('btn-success');
            $(this).addClass('btn-danger');
            $(this).html('Desactivado');
            $(this).attr('estadoCategoria', 1);

        } else {

            $(this).addClass('btn-success');
            $(this).removeClass('btn-danger');
            $(this).html('Activado');
            $(this).attr('estadoCategoria', 0);

        }
    })
    /*=============================================
    REVISAR SI LA CATEGORÍA YA EXISTE
    =============================================*/

$(".validarCategoria").change(function() {

    $(".alert").remove();

    var categoria = $(this).val();
    // console.log("categoria", categoria);

    var datos = new FormData();
    datos.append("validarCategoria", categoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            // console.log("respuesta", respuesta);

            if (respuesta) {

                $(".validarCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe en la base de datos</div>')
                $(".validarCategoria").val("");
            }

        }

    })
});
/*=============================================
RUTA CATEGORÍA
=============================================*/

function limpiarUrl(texto) {

    var texto = texto.toLowerCase();
    texto = texto.replace(/[á]/, 'a');
    texto = texto.replace(/[é]/, 'e');
    texto = texto.replace(/[í]/, 'i');
    texto = texto.replace(/[ó]/, 'o');
    texto = texto.replace(/[ú]/, 'u');
    texto = texto.replace(/[ñ]/, 'n');
    texto = texto.replace(/ /g, '-');
    return texto;

}


$(".tituloCategoria").change(function() {

    $(".rutaCategoria").val(

        limpiarUrl($(".tituloCategoria").val())

    );

})

/**EDITAR CATEGORIA */
$(".tablaCategorias tbody").on("click", ".btnEditarCategoria", function() {

    var idCategoria = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            $("#modalEditarCategoria .editarIdCategoria").val(respuesta["id"]);

            $("#modalEditarCategoria .tituloCategoria").val(respuesta["categoria"]);
            $("#modalEditarCategoria .rutaCategoria").val(respuesta["ruta"]);

            /*=============================================
            EDITAR NOMBRE CATEGORÍA Y RUTA
            =============================================*/

            $("#modalEditarCategoria .tituloCategoria").change(function() {

                $("#modalEditarCategoria .rutaCategoria").val(limpiarUrl($("#modalEditarCategoria .tituloCategoria").val()));

            })
        }
    })
})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablaCategorias tbody").on("click", ".btnEliminarCategoria", function() {

    var idCategoria = $(this).attr("idCategoria");


    swal({
        title: '¿Está seguro de borrar la categoría?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoría'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;

        }

    })

})