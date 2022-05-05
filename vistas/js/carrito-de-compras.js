$(function() {

    $('.showButton').click(function() {

        $('.hidden').show();

        $('.show').hide();
    });

    $('.hideButton').click(function() {

        $('.hidden').hide();

        $('.show').show();

    });

});

// VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
if (localStorage.getItem("cantidadCesta") != null) {
    $(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
    $(".sumaCesta").html(localStorage.getItem("sumaCesta"));
} else {
    $(".cantidadCesta").html("0");
    $(".sumaCesta").html("0");
}

/*=============================================

VISUALIZAR LOS PRODUCTOS EN LA PÁGINA CARRITO DE COMPRAS

=============================================*/


if (localStorage.getItem("listaProductos") != null) {

    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

    listaCarrito.forEach(funcionForEach);

    function funcionForEach(item, index) {

        var datosProducto = new FormData();
        var precio = 0;

        datosProducto.append("id", item.idProducto);
        $.ajax({
            url: rutaOculta + "ajax/producto.ajax.php",
            method: "POST",
            data: datosProducto,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                if (respuesta["precioOferta"] == 0) {

                    precio = respuesta["precio"];

                } else {

                    precio = respuesta["precioOferta"];

                }

                $(".cuerpoCarrito").append('<tr>' +

                    '<td>' +

                    '<div class="product-item">' +

                    '<a class="product-thumb" href="#"><img src="' + item.imagen + '"></a>' +

                    '<div class="product-info align-middle">' +

                    '<h4 class="product-title tituloCarritoCompra ">' + item.titulo + '</h4>' +

                    '</div>' +

                    '</div>' +

                    '</td>' +

                    '<td class="text-center text-lg text-medium"><h5 class="precioCarritoCompra">$ <span> ' + precio + ' </span></h5></td>' +

                    '<td class="text-center">' +

                    '<div class="count-input">' +

                    '<input type="number" class="form-control cantidadItem" min="1" max="' + item.inventario + '" value="' + item.cantidad + '" precio="' + precio + '" idProducto="' + item.idProducto + '" item="' + index + '" tipo="' + item.tipo + '" style="text-align:center !important;">' +

                    '</div>' +

                    '</td>' +

                    '<td class="text-center text-lg text-medium"><h5 class="subTotal' + index + ' subtotales">$<span> ' + (Number(item.cantidad) * Number(item.precio)) + ' </span></h5></td>' +

                    '<td class="text-center"><button class="btn btn-default backColor quitarItemCarrito" idProducto="' + item.idProducto + '"  peso="' + item.peso + '"><i class="fa fa-trash"></i></button>' +

                    '</tr>');
                /*=============================================
                    ACCTUALIZAR SUBTOTAL
                    =============================================*/

                var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");

                var cantidadItem = $(".cuerpoCarrito .cantidadItem");

                for (var i = 0; i < precioCarritoCompra.length; i++) {

                    var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();

                    var cantidadItemArray = $(cantidadItem[i]).val();

                    var idProductoArray = $(cantidadItem[i]).attr("idProducto");


                    $(".subTotal" + idProductoArray).html('<span>$ ' + (precioCarritoCompraArray * cantidadItemArray) + ' </span>');

                    sumaSubtotales();
                    cestaCarrito(precioCarritoCompra.length);

                }
            }
        })

    }



} else {

    // $(".cuerpoCarrito").html('<div class="container p-3"><h3>Aún no hay productos en el carrito de compras.</h3></div>');
    $(".cuerpoCarrito").html('<tr><td><div class="container p-3"><h3>Aún no hay productos en el carrito de compras.</h3></div></td></tr>');


    $(".sumaCarrito").hide();

    $(".cabeceraCheckout").hide();

}

/*=============================================

AGREGAR AL CARRITO

=============================================*/

$(".agregarCarrito").click(function() {



    var idProducto = $(this).attr("idProducto");

    var imagen = $(this).attr("imagen");

    var titulo = $(this).attr("titulo");

    var tipo = $(this).attr("tipo");

    var inventario = $(this).attr("inventario");

    var precio = $(this).attr("precio");

    var peso = $(this).attr("peso");


    var agregarAlCarrito = true;



    /*=============================================

	ALMACENAR EN EL LOCALSTARGE LOS PRODUCTOS AGREGADOS AL CARRITO

	=============================================*/

    if (agregarAlCarrito) {

        /*=============================================
		RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
		=============================================*/

        if (localStorage.getItem("listaProductos") == null) {

            listaCarrito = [];

        } else {

            var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

            for (var i = 0; i < listaProductos.length; i++) {

                if (listaProductos[i]["idProducto"] == idProducto) {

                    swal({
                        title: "El producto ya esta agregado en el carrito de compras",
                        text: "",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Volver",
                        closeOnConfirm: false
                    })

                    return;

                }

            }

            listaCarrito.concat(localStorage.getItem("listaProductos"));

            // console.log("listaCarrito", listaCarrito);

        }

        listaCarrito.push({

            "idProducto": idProducto,

            "imagen": imagen,

            "titulo": titulo,

            "tipo": tipo,

            "inventario": inventario,

            "precio": precio,

            "peso": peso,

            "cantidad": "1"
        });

        // "subtotal": (precio * 1)

        // console.log("listCarrito", listaCarrito);


        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

        /*============================================
		ACTUALIZAR LA CESTA
		=============================================*/

        var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
        var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);


        $(".cantidadCesta").html(cantidadCesta);
        $(".sumaCesta").html(sumaCesta);


        localStorage.setItem("cantidadCesta", cantidadCesta);
        localStorage.setItem("sumaCesta", sumaCesta);

        /*=============================================
        MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
        =============================================*/

        swal({
                title: "",
                text: "¡Se ha agregado un nuevo producto al carrito de compras!",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "¡Continuar comprando!",
                confirmButtonText: "¡Ir a mi carrito de compras!",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location = rutaOculta + "carrito-de-compras";
                }
            });

    }

})

/*=============================================

QUITAR PRODUCTOS DEL CARRITO

=============================================*/

$(document).on("click", ".quitarItemCarrito", function() {

    // $(".quitarItemCarrito").click(function() {

    $(this).parent().parent().remove();

    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var cantidad = $(".cuerpoCarrito .cantidadItem");

    /*=============================================
    SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
    =============================================*/

    listaCarrito = [];

    if (idProducto.length != 0) {

        for (var i = 0; i < idProducto.length; i++) {

            var idProductoArray = $(idProducto[i]).attr("idProducto");
            var imagenArray = $(imagen[i]).attr("src");
            var tituloArray = $(titulo[i]).html();
            var precioArray = $(precio[i]).html();
            var pesoArray = $(idProducto[i]).attr("peso");
            var cantidadArray = $(cantidad[i]).val();

            listaCarrito.push({

                "idProducto": idProductoArray,
                "imagen": imagenArray,
                "titulo": tituloArray,
                "precio": precioArray,
                "peso": pesoArray,
                "cantidad": cantidadArray

            });

        }

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

        sumaSubtotales();
        cestaCarrito(listaCarrito.length);

    } else {

        localStorage.removeItem("listaProductos");

        localStorage.setItem("cantidadCesta", "0");

        localStorage.setItem("sumaCesta", "0");

        $(".cantidadCesta").html("0");

        $(".sumaCesta").html("0");


        $(".cuerpoCarrito").html('<div class="container p-3"><h3>Aún no hay productos en el carrito de compras.</h3></div>');

        $(".sumaCarrito").hide();

        $(".cabeceraCheckout").hide();

    }



})

/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/

$(document).on("change", ".cantidadItem", function() {

    var cantidad = $(this).val();
    var precio = $(this).attr("precio");
    var idProducto = $(this).attr("idProducto");
    var item = $(this).attr("item");

    $(".subTotal" + item).html('<strong>$<span>' + (cantidad * precio) + '</span></strong>');

    /*=============================================
    ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
    =============================================*/

    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var cantidad = $(".cuerpoCarrito .cantidadItem");

    listaCarrito = [];

    for (var i = 0; i < idProducto.length; i++) {

        var idProductoArray = $(idProducto[i]).attr("idProducto");
        var imagenArray = $(imagen[i]).attr("src");
        var tituloArray = $(titulo[i]).html();
        var precioArray = $(precio[i]).html();
        var pesoArray = $(idProducto[i]).attr("peso");
        var cantidadArray = $(cantidad[i]).val();

        listaCarrito.push({
            "idProducto": idProductoArray,
            "imagen": imagenArray,
            "titulo": tituloArray,
            "precio": precioArray,
            "peso": pesoArray,
            "cantidad": cantidadArray
        });

    }

    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

    sumaSubtotales();
    cestaCarrito(listaCarrito.length);

})



/*=============================================Suma de subtotales=============================================*/
function sumaSubtotales() {

    var subtotales = $(".subtotales span");
    var arraySumaSubtotales = [];

    for (var i = 0; i < subtotales.length; i++) {

        var subtotalesArray = $(subtotales[i]).html();
        arraySumaSubtotales.push(Number(subtotalesArray));

    }
    // console.log("arraySumaSubtotales", arraySumaSubtotales);

    function sumaArraySubtotales(total, numero) {

        return total + numero;

    }

    var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
    // console.log("sumaTotal", sumaTotal);

    $(".sumaSubTotal").html('<strong>$ <span>' + (sumaTotal).toFixed(2) + '</span></strong>');

    $(".sumaCesta").html((sumaTotal).toFixed(2));

    localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));

}

/**ACTUALIZAR CESTA AL CAMBIAR  CANTIDAD*/

function cestaCarrito(cantidadProductos) {
    /*se verifica si hay productos en el carrito*/

    if (cantidadProductos != 0) {
        // console.log("cantidadProductos", cantidadProductos);

        var cantidadItem = $(".cuerpoCarrito .cantidadItem");
        var arraySumaCantidades = [];

        for (var i = 0; i < cantidadItem.length; i++) {

            var cantidadItemArray = $(cantidadItem[i]).val();
            arraySumaCantidades.push(Number(cantidadItemArray));

        }
        // console.log("arraySumaSubtotales", arraySumaSubtotales);

        function sumaArrayCantidades(total, numero) {

            return total + numero;

        }

        var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);
        // console.log("sumaTotalCantidades", sumaTotalCantidades);

        $(".cantidadCesta").html(sumaTotalCantidades);
        localStorage.getItem("cantidadCesta", sumaTotalCantidades);

    }

}


/**CHECKOUT*/

$("#btnCheckout").click(function() {

    $(".listaProductos table.tablaProductos tbody").html("");

    var idUsuario = $(this).attr("idUsuario");

    var peso = $(".cuerpoCarrito button");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
    var cantidad = $(".cuerpoCarrito .cantidadItem");
    var subtotal = $(".cuerpoCarrito .subtotales span");
    var tipoArray = [];
    var cantidadPeso = [];
    /**SUMA SUBTOTAL */

    var sumaSubTotal = $(".sumaSubTotal span");

    $(".valorSubtotal").html($(sumaSubTotal).html());
    $(".valorSubtotal").attr("valor", $(sumaSubTotal).html());

    /**IMPUESTO */

    var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) / 100;
    $(".valorTotalImpuesto").html(impuestoTotal.toFixed(2));
    $(".valorTotalImpuesto").attr("valor", $(sumaSubTotal).html());
    sumaTotalCompra();

    /**VARIABLES ARRAY */

    for (var i = 0; i < titulo.length; i++) {

        var pesoArray = $(peso[i]).attr("peso");
        var tituloArray = $(titulo[i]).html();
        var cantidadArray = $(cantidad[i]).val();
        var subtotalArray = $(subtotal[i]).html();
        cantidadPeso[i] = pesoArray * cantidadArray;


        /**PESO DE ACUERDO A LA CANTIDAD */

        cantidadPeso[i] = pesoArray * cantidadArray;
        //    console.log("cantidadPeso", cantidadPeso);

        function sumaArrayPeso(total, numero) {

            return total + numero;

        }
        var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);
        // console.log("sumaTotalPeso", sumaTotalPeso);


        /**MOSTRAR PRODUCTOS DEFINITIVOS */

        $(".listaProductos table.tablaProductos tbody").append('<tr>' +
            '<td class="valorTitulo">' + tituloArray + '</td>' +
            '<td class="valorCantidad">' + cantidadArray + '</td>' +
            '<td>$ <span class="valorItem" valor="' + subtotalArray + '">' + subtotalArray + '</span></td>' +
            '</tr>');

        /**MOSTRAR pais si es fisico*/

        tipoArray.push($(cantidad[i]).attr("tipo"));


        function checkTipo(tipo) {
            return tipo == "fisico";
        }
    }
    /**existen productos fisicos*/
    if (tipoArray.find(checkTipo) == "fisico") {
        $(".formEnvio").show();
        $(".btnPagar").attr("tipo", "fisico");

        $.ajax({
            url: rutaOculta + "vistas/js/plugins/countries.json",
            type: "GET",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                respuesta.forEach(seleccionarCiudad);

                function seleccionarCiudad(item, index) {

                    var ciudad = item.name;
                    var codCiudad = item.code;

                    $("#seleccionarCiudad").append('<option value="' + codCiudad + '">' + ciudad + '</option>');

                }

            }
        })

        /**EVUALUAR TASA DE ENVIO */

        $("#seleccionarCiudad").change(function() {
            $(".alert").remove();

            var ciudad = $(this).val();
            var tasaCiudad = $("#tasaCiudad").val();

            if (ciudad == tasaCiudad) {
                var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();
                //    console.log("resultadoPeso", resultadoPeso);
                if (resultadoPeso < $("#tasaMinimaNal").val()) {
                    $(".valorTotalEnvio").html($("#tasaMinimaNal").val());
                    $(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val());
                } else {
                    $(".valorTotalEnvio").html(resultadoPeso);
                    $(".valorTotalEnvio").attr("valor", resultadoPeso);
                }

            } else {
                var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();
                //    console.log("resultadoPeso", resultadoPeso);
                if (resultadoPeso < $("#tasaMinimaInt").val()) {

                    $(".valorTotalEnvio").html($("#tasaMinimaInt").val());
                    $(".valorTotalEnvio").attr("valor", $("#tasaMinimaInt").val());

                } else {
                    $(".valorTotalEnvio").html(resultadoPeso);
                    $(".valorTotalEnvio").attr("valor", resultadoPeso);
                }
            }
            sumaTotalCompra();
        })

    } else {
        $(".btnPagar").attr("tipo", "virtual");
    }


})

var metodoPago = "paypal";

$("input[name='pago']").change(function() {

    var metodoPago = $(this).val();

    if (metodoPago == "payu") {

        $(".btnPagar").hide();
        $(".btnTransferencia").show();

    } else {

        $(".btnPagar").show();
        $(".btnTransferencia").hide();

    }

})




/**SUMA TOTA COMPTA*/
function sumaTotalCompra() {

    var sumaTotalTasas = Number($(".valorSubtotal").html()) + Number($(".valorTotalEnvio").html()) + Number($(".valorTotalImpuesto").html());
    // var sumaTotalTasas = Number($(".valorSubtotal").html())+Number($(".valorTotalEnvio").html());

    $(".valorTotalCompra").html(sumaTotalTasas.toFixed(2));
    $(".valorTotalCompra").attr("valor", sumaTotalTasas.toFixed(2));

    localStorage.setItem("total", hex_md5($(".valorTotalCompra").html()));

}

/**BOTON DE COMPRA*/
$(".btnPagar").click(function() {
    var tipo = $(this).attr("tipo");

    if (tipo == "fisico" && $("#seleccionarCiudad").val() == "") {

        $(".btnPagar").after('<div class="alert alert-warning mt-2">No ha seleccionado la ciudad de envío</div>');

        return;

    }

    var divisa = $("#cambiarDivisa").val();

    var total = $(".valorTotalCompra").html();

    var totalEncriptado = localStorage.getItem("total");

    var impuesto = $(".valorTotalImpuesto").html();

    var envio = $(".valorTotalEnvio").html();

    var subtotal = $(".valorSubtotal").html();

    var titulo = $(".valorTitulo");

    var cantidad = $(".valorCantidad");

    var valorItem = $(".valorItem");

    var idProducto = $('.cuerpoCarrito button');



    var tituloArray = [];
    var cantidadArray = [];
    var valorItemArray = [];
    var idProductoArray = [];

    for (var i = 0; i < titulo.length; i++) {
        tituloArray[i] = $(titulo[i]).html();
        cantidadArray[i] = $(cantidad[i]).html();
        valorItemArray[i] = $(valorItem[i]).html();
        idProductoArray[i] = $(idProducto[i]).attr("idProducto");
    }

    var datos = new FormData();

    datos.append("divisa", divisa);
    datos.append("total", total);
    datos.append("totalEncriptado", totalEncriptado);
    datos.append("impuesto", impuesto);
    datos.append("envio", envio);
    datos.append("subtotal", subtotal);
    datos.append("tituloArray", tituloArray);
    datos.append("cantidadArray", cantidadArray);
    datos.append("valorItemArray", valorItemArray);
    datos.append("idProductoArray", idProductoArray);

    $.ajax({
        url: rutaOculta + "ajax/carrito.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            window.location = respuesta;
            // console.log("respuesta", respuesta);

        }

    })

})

// btnTransferencia.onclick = function() {

//     var doc = new jsPDF('p', 'pt', 'letter');
//     var margin = 10;
//     var scale = (doc.internal.pageSize.width - margin * 2) / document.body.scrollWidth;
//     doc.html(document.body, {
//         x: margin,
//         y: margin,
//         html2canvas: {
//             scale: scale,
//         },
//         callback: function(doc) {
//             doc.output('dataurlnewwindow', { filename: 'formato-pago.pdf' });
//         }
//     });

// }