/**CARGA DINAMICA DE TABLA VENTAS */



// $.ajax({

//     url: "ajax/datatable-ventas.ajax.php",

//     success: function(respuesta) {

//         console.log("respuesta", respuesta);

//     }

// })

$('.tablaRegistroVentas').DataTable({

    "ajax": "ajax/datatable-ventas.ajax.php",

    "deferRender": true,

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



/**AGREGAR PRODUCTOS A LA TABLA DE VENTAS */



$(".tablaRegistroVentas tbody").on("click", "button.agregarProducto", function() {

    var idProducto = $(this).attr("idProducto");

    // console.log("idProducto", idProducto);



    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");





    var datos = new FormData();

    datos.append("idProducto", idProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",

        method: "POST",

        data: datos,

        cache: false,

        contentType: false,

        processData: false,

        dataType: "json",

        success: function(respuesta) {

            var titulo = respuesta[0]["titulo"];

            var precio = respuesta[0]["precio"];

            var inventario = respuesta[0]["inventario"];



            /**EVITAR AGREGAR SI INVENTARIO ESTA EN 0 */



            if (inventario == 0) {

                swal({

                    title: "No hay existencias en el inventario",

                    type: "error",

                    confirmButtonText: "Cerrar"

                });

                $("button[idProducto='" + idProducto + "']").addClass("btn-primary agregarProducto");



                return;

            }

            $(".nuevoProducto").append(

                    '<div class="row" style="padding:5px 15px">' +

                    '<div class="col-xs-6" style="padding-right: 0px;">' +

                    ' <div class="input-group">' +

                    '<span class="input-group-addon">' +

                    '<button  type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button>' +

                    ' </span>' +

                    ' <input type="text" name="agregarProducto" id="agregarProducto" class="form-control nuevaDescripcionProducto" idProducto="' + idProducto + '" value="' + titulo + '" readonly required>' +

                    ' </div>' +

                    '</div>' +

                    '<div class="col-xs-3">' +

                    ' <input type="number" name="nuevaCantidadProducto" id="nuevaCantidadProducto" class="form-control nuevaCantidadProducto" min="1"  value ="1" required>' +

                    '</div> ' +

                    ' <div class="col-xs-3 ingresoPrecio" style="padding-left: 0px;">' +

                    ' <div class="input-group">' +

                    '<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>' +

                    ' <input type="text" name="nuevoPrecioProducto" id="nuevoPrecioProducto" class="form-control nuevoPrecioProducto" precioReal="' + precio + '" value="' + precio + '" readonly required>' +

                    '</div>' +



                    '</div>' +

                    '</div>')

                //sumar total

            sumarTotalPrecios();

            agregarImpuesto();
	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

            //formato de precio de los productos

            $(".nuevoPrecioProducto").number(true, 2);

        }



    })

});

$(".tablaRegistroVentas").on("draw.dt", function() {

    if (localStorage.getItem("quitarProducto") != null) {

        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        for (var i = 0; i < listaIdProductos.length; i++) {

            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');

            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');

        }

    }



})



/**QUITAR PRODUCTOS DE LA VENTA */



var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");



$(".formularioRegistroVenta").on("click", "button.quitarProducto", function() {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");



    /** almacenar id de producto a quitar en ls*/

    if (localStorage.getItem("quitarProducto") == null) {

        idQuitarProducto = [];



    } {

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }

    idQuitarProducto.push({ "idProducto": idProducto });

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $(".nuevoTotalVenta").val(0);

        $("#totalVenta").val(0);

        $(".nuevoImpuestoVenta").val(0);

        $(".nuevoTotalVenta").attr("total", 0);

    } else {

        //sumar total

        sumarTotalPrecios()

        agregarImpuesto()
        //agrupar en json
        listarProductos()

    }

})



/**Agregar producto desde vista movil */



$(".btnAgregarProducto").click(function() {

        var datos = new FormData();

        datos.append("traerProductos", "ok");



        $.ajax({

            url: "ajax/productos.ajax.php",

            method: "POST",

            data: datos,

            cache: false,

            contentType: false,

            processData: false,

            dataType: "json",

            success: function(respuesta) {

                //console.log("respuesta", respuesta);

                $(".nuevoProducto").append(

                    '<div class="row" style="padding:5px 15px">' +

                    '<div class="col-xs-6" style="padding-right: 0px;">' +

                    ' <div class="input-group">' +

                    '<span class="input-group-addon">' +

                    '<button  type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button>' +

                    ' </span>' +

                    ' <select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>' +

                    '<option>Seleccionar producto</option>' +

                    '</select>' +

                    ' </div>' +

                    '</div>' +

                    '<div class="col-xs-3">' +

                    ' <input type="number" name="nuevaCantidadProducto" id="nuevaCantidadProducto" class="form-control nuevaCantidadProducto" min="1" value ="1"  required>' +

                    '</div> ' +

                    ' <div class="col-xs-3 ingresoPrecio" style="padding-left: 0px;">' +

                    ' <div class="input-group">' +

                    '<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>' +

                    ' <input type="number" name="nuevoPrecioProducto" id="nuevoPrecioProducto" class="form-control nuevoPrecioProducto" value="" readonly required>' +

                    '</div>' +



                    '</div>' +

                    '</div>');



                /**AGREGAR PRODUCTOS AL SELECT */

                respuesta.forEach(funcionForEach);



                function funcionForEach(item, index) {

                    $(".nuevaDescripcionProducto").append(

                        '<option idProducto="' + item.id + '" value="' + item.titulo + '">' + item.titulo + '</option>'

                    )

                }

            }

        })

    })

$(".formularioRegistroVenta").on("change", "input.nuevaCantidadProducto", function() {

    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);



    //sumar total

    sumarTotalPrecios()
    agregarImpuesto()
    //agrupar en json
    listarProductos()

})



/**SUMAR PRECIOS */



function sumarTotalPrecios() {

    var precioItem = $(".nuevoPrecioProducto");

    var arraySumaPrecio = [];



    for (var i = 0; i < precioItem.length; i++) {

        arraySumaPrecio.push(Number($(precioItem[i]).val()));



    }

    function sumaArrayPrecios(total, numero) {

        return total + numero;

    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    $(".nuevoTotalVenta").val(sumaTotalPrecio);
    $("#totalVenta").val(sumaTotalPrecio);
    $(".nuevoTotalVenta").attr("total", sumaTotalPrecio);



}



 function agregarImpuesto() {

     var impuesto = $("#nuevoImpuestoVenta").val();

     var precioTotal = $(".nuevoTotalVenta").attr("total");

     var precioImpuesto = Number(precioTotal * impuesto/100);

     var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);



     $(".nuevoTotalVenta").val(totalConImpuesto);
     $("#totalVenta").val(totalConImpuesto);
     $("#nuevoPrecioImpuesto").val(precioImpuesto);
     $("#nuevoPrecioNeto").val(precioTotal);



 }

 /**CUANDO CAMBIA EL IMPUESTO */

 $("#nuevoImpuestoVenta").change(function(){
    agregarImpuesto();
 })
//formato de precio final

$(".nuevoTotalVenta").number(true, 2);



/**seleccionar metodo de pago */

$("#nuevoMetodoPago").change(function(){

    var metodo = $(this).val();

    if(metodo == "Efectivo"){

        $(this).parent().parent().removeClass("col-xs-6");

        //listar metodo de pago

        listarMetodos();

    }else{

        $(this).parent().parent().parent().children('.cajasMetodoPago').html(
            '<div class="col-xs-6" style="padding-left:0px">'+

                '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                    '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>'+
                '</div>'+
            '</div>')

    }
})

/**CAMBIO A TRANSACCION */
$(".formularioRegistroVenta").on("change", "input#nuevoCodigoTransaccion",function(){
    //listarMETODOS DE PAGO

    listarMetodos();
})

/**LISTAR LOS PRODUCTOS */

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var titulo = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < titulo.length; i++){

		listaProductos.push({ "id" : $(titulo[i]).attr("idProducto"), 
                              "titulo" : $(titulo[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})


	}
    console.log("listaProductos", JSON.stringify(listaProductos));

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}



/**LISTAR LOS metodo de pago */

function listarMetodos(){
    var listaMetodos = "";

  if($("#nuevoMetodoPago").val() == "Efectivo") {
        $("#listaMetodoPago").val("Efectivo");
    }else{
        $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
    }   
}

//PROCESO DE ENVIO
$(".tablas tbody").on("click", ".btnEnvio", function(){
    var idVentaTransferencia = $(this).attr("idVentaTransferencia");
    var etapa = $(this).attr("etapa");

    var datos = new FormData();
    datos.append("idVentaTransferencia", idVentaTransferencia);
    datos.append("etapa", etapa);

    $.ajax({
        url: "ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        success:function(respuesta){
            console.log("respuesta", respuesta);
        }
    });
    if(etapa == 1){
        $(this).addClass('btn-warning');
        $(this).removeClass('btn-danger');
        $(this).html('Enviando el producto');
        $(this).attr('etapa', 2);
    }
    if(etapa == 2){
        $(this).addClass('btn-success');
        $(this).removeClass('btn-warning');
        $(this).html('Producto entregado');

    }

})

//PROCESO DE ENVIO
$(".tablas tbody").on("click", ".btnProceso", function(){
    var idPagoVentaTransferencia = $(this).attr("idPagoVentaTransferencia");
    var etapa = $(this).attr("etapa");

    var datos = new FormData();
    datos.append("idPagoVentaTransferencia", idPagoVentaTransferencia);
    datos.append("etapa", etapa);

    $.ajax({
        url: "ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        success:function(respuesta){
            console.log("respuesta", respuesta);
        }
    });
    if(etapa == 1){
        $(this).addClass('btn-warning');
        $(this).removeClass('btn-info');
        $(this).html('Verificación del pago');
        $(this).attr('etapa', 2);
    }
    if(etapa == 2){
        $(this).addClass('btn-success');
        $(this).removeClass('btn-warning');
        $(this).html('Pago aprobado');

    }

})