// $.ajax({

//     url: "ajax/productos.ajax.php",

//     success: function(respuesta) {

//         console.log("respuesta", respuesta);

//     }



// })



$('.tablaProductos').DataTable({



    "ajax": "ajax/tablaProductos.ajax.php",

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

/*=============================================
ACTIVAR PRODUCTO
=============================================*/
$('.tablaProductos tbody').on("click", ".btnActivar", function() {

        var idProducto = $(this).attr("idProducto");
        var estadoProducto = $(this).attr("estadoProducto");

        var datos = new FormData();
        datos.append("activarId", idProducto);
        datos.append("activarProducto", estadoProducto);

        $.ajax({

            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                //console.log("respuesta", respuesta);

            }

        })

        if (estadoProducto == 0) {

            $(this).removeClass('btn-success');
            $(this).addClass('btn-danger');
            $(this).html('Desactivado');
            $(this).attr('estadoProducto', 1);

        } else {

            $(this).addClass('btn-success');
            $(this).removeClass('btn-danger');
            $(this).html('Activado');
            $(this).attr('estadoProducto', 0);

        }

    })
    /*=============================================
    REVISAR SI EL TITULO DEL PRODUCTO YA EXISTE
    =============================================*/

$(".validarProducto").change(function() {

        $(".alert").remove();

        var producto = $(this).val();

        var datos = new FormData();
        datos.append("validarProducto", producto);

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                if (respuesta.length != 0) {

                    $(".validarProducto").parent().after('<div class="alert alert-warning">Este título de producto ya existe en la base de datos</div>');

                    $(".validarProducto").val("");

                }

            }

        })

    })
    /*=============================================
    RUTA PRODUCTO
    =============================================*/

function limpiarUrl(texto) {
    var texto = texto.toLowerCase();
    texto = texto.replace(/[á]/, 'a');
    texto = texto.replace(/[é]/, 'e');
    texto = texto.replace(/[í]/, 'i');
    texto = texto.replace(/[ó]/, 'o');
    texto = texto.replace(/[ú]/, 'u');
    texto = texto.replace(/[ñ]/, 'n');
    texto = texto.replace(/ /g, "-")
    return texto;
}

$(".tituloProducto").change(function() {

    $(".rutaProducto").val(limpiarUrl($(".tituloProducto").val()));

})

/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/

var arrayFiles = [];

$(".multimediaFisica").dropzone({

    url: "/",
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg, image/png",
    maxFilesize: 2,
    maxFiles: 10,
    init: function() {

        this.on("addedfile", function(file) {

            arrayFiles.push(file);

            // console.log("arrayFiles", arrayFiles);

        })

        this.on("removedfile", function(file) {

            var index = arrayFiles.indexOf(file);

            arrayFiles.splice(index, 1);

            // console.log("arrayFiles", arrayFiles);

        })

    }

})

/*=============================================
SUBIENDO LA FOTO PRINCIPAL
=============================================*/

var imagenFotoPrincipal = null;

$(".fotoPrincipal").change(function() {

    imagenFotoPrincipal = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

    if (imagenFotoPrincipal["type"] != "image/jpeg" && imagenFotoPrincipal["type"] != "image/png") {

        $(".fotoPrincipal").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagenFotoPrincipal["size"] > 2000000) {

        $(".fotoPrincipal").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagenFotoPrincipal);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $(".previsualizarPrincipal").attr("src", rutaImagen);

        })

    }

})

/*=============================================
ACTIVAR OFERTA
=============================================*/

function activarOferta(event) {

    if (event == "oferta") {

        $(".datosOferta").show();
        $(".valorOferta").prop("required", true);
        $(".valorOferta").val("");


    } else {

        $(".datosOferta").hide();
        $(".valorOferta").prop("required", false);
        $(".valorOferta").val("");

    }
}


$(".selActivarOferta").change(function() {

    activarOferta($(this).val())

})

/*=============================================
VALOR OFERTA
=============================================*/

$("#modalCrearProducto .valorOferta").change(function() {

        if ($(".precio").val() != 0) {

            if ($(this).attr("tipo") == "oferta") {

                var descuento = 100 - (Number($(this).val()) * 100 / Number($(".precio").val()));

                $(".precioOferta").prop("readonly", true);
                $(".descuentoOferta").prop("readonly", false);
                $(".descuentoOferta").val(Math.ceil(descuento));

            }

            if ($(this).attr("tipo") == "descuento") {

                var oferta = Number($(".precio").val()) - (Number($(this).val()) * Number($(".precio").val()) / 100);

                $(".descuentoOferta").prop("readonly", true);
                $(".precioOferta").prop("readonly", false);
                $(".precioOferta").val(oferta);

            }

        } else {

            swal({
                title: "Error al agregar la oferta",
                text: "¡Primero agregue un precio al producto!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

            $(".precioOferta").val(0);
            $(".descuentoOferta").val(0);

            return;

        }

    })
    /*=============================================
    SUBIENDO LA FOTO DE LA OFERTA
    =============================================*/

var imagenOferta = null;

$(".fotoOferta").change(function() {

    imagenOferta = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

    if (imagenOferta["type"] != "image/jpeg" && imagenOferta["type"] != "image/png") {

        $(".fotoOferta").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagenOferta["size"] > 2000000) {

        $(".fotoOferta").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagenOferta);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $(".previsualizarOferta").attr("src", rutaImagen);

        })

    }
})

/*=============================================
CAMBIAR EL PRECIO
=============================================*/

$(".precio").change(function() {

    $(".precioOferta").val(0);
    $(".descuentoOferta").val(0);

})

/*=============================================
CAMBIAR EL PRECIO
=============================================*/
var multimediaFisica = null;
var multimediaVirtual = null;
var tipo = null;

$(".guardarProducto").click(function() {
    /*=============================================
    Validacion de campos vacios
    =============================================*/
    if ($(".tituloProducto").val() != "" &&
        $(".seleccionarTipo").val() != "" &&
        $(".seleccionarCategoria").val() != "" &&
        $(".descripcionProducto").val() != "" &&
        $(".precio").val() != "" && 
        $(".inventario").val() != "" &&
        $(".entrega").val() != "" ) {


            if(tipo != "virtual"){
                if (arrayFiles.length > 0 && $(".rutaProducto").val() != "") {
                    var listaMultimedia = [];
                    var finalFor = 0;

                    for (var i = 0; i < arrayFiles.length; i++){

                        var datosMultimedia = new FormData();
                        datosMultimedia.append("file", arrayFiles[i]);
                        datosMultimedia.append("ruta", $(".rutaProducto").val());

                        $.ajax({
                            url: "ajax/productos.ajax.php",
                            method: "POST",
                            data: datosMultimedia,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function(){
                                $(".modal-footer .preload").html(`


                                <center>

                                    <img src="vistas/img/plantilla/status.gif" id="status" />
                                    <br>

                                </center>

                            `);
                            },
                            success: function(respuesta) {
                           console.log("respuesta", respuesta);
                             $("#status").remove();
        
                                listaMultimedia.push({ "foto": respuesta.substr(3) })
                                multimediaFisica = JSON.stringify(listaMultimedia);
                                multimediaVirtual = null;
        
                               if (multimediaFisica == null) {
                                            
                                    swal({
                                        title: "El campo de multimedia no debe estar vacío",
                                        type: "error",
                                        confirmButtonText: "¡Cerrar!"
                                    });
        
                                    return;

                                }

                                if((finalFor + 1) == arrayFiles.length){
                                    agregarMiProducto(multimediaFisica);
                                    finalFor = 0;
                                }
                                finalFor++;
        
                            }
        
                        })


                    }

                }

            }
        }else{

            swal({
                title: "Llenar todos los campos obligatorios",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

            return;

        }
 
    })
function agregarMiProducto(imagen){
       /* =============================================
        ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
        =============================================*/

        var tituloProducto = $(".tituloProducto").val();
        var rutaProducto = $(".rutaProducto").val();
        var seleccionarTipo = $(".seleccionarTipo").val();
        var seleccionarCategoria = $(".seleccionarCategoria").val();
        var descripcionProducto = $(".descripcionProducto").val();
        var precio = $(".precio").val();
        var inventario = $(".inventario").val();
        var entrega = $(".entrega").val();
        var selActivarOferta = $(".selActivarOferta").val();
        var precioOferta = $(".precioOferta").val();
        var descuentoOferta = $(".descuentoOferta").val();
        var finOferta = $(".finOferta").val();
        if(seleccionarTipo == "fisico"){
            var detalles = {
                "Ancho": $(".detalleAncho").val(),
                "Largo": $(".detalleLargo").val(),
                "Alto": $(".detalleAlto").val(),
                "Peso": $(".detallePeso").val(),
                "Calibre": $(".detalleCalibre").val()
            };

        }

        var detallesString = JSON.stringify(detalles);

        var datosProducto = new FormData();
        datosProducto.append("tituloProducto", tituloProducto);
        datosProducto.append("rutaProducto", rutaProducto);
        datosProducto.append("seleccionarTipo", seleccionarTipo);
        datosProducto.append("detalles", detallesString);
        datosProducto.append("seleccionarCategoria", seleccionarCategoria);
        datosProducto.append("descripcionProducto", descripcionProducto);
        datosProducto.append("precio", precio);
        datosProducto.append("inventario", inventario);
        datosProducto.append("entrega", entrega);
        datosProducto.append("multimedia", imagen);
        datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
        datosProducto.append("selActivarOferta", selActivarOferta);
        datosProducto.append("precioOferta", precioOferta);
        datosProducto.append("descuentoOferta", descuentoOferta);
        datosProducto.append("finOferta", finOferta);
        datosProducto.append("fotoOferta", imagenOferta);

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datosProducto,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

              //  console.log("respuesta", respuesta);

                if (respuesta == "ok") {

                    swal({
                        type: "success",
                        title: "El producto ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {

                            window.location = "productos";

                        }
                    })
                }

            }

        })
}



$('.tablaProductos tbody').on("click", ".btnEditarProducto", function() {
    $(".previsualizarImgFisico").html("");

    var idProducto = $(this).attr("idProducto");

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

            $("#modalEditarProducto .idProducto").val(respuesta[0]["id"]);
            $("#modalEditarProducto .tituloProducto").val(respuesta[0]["titulo"]);
            $("#modalEditarProducto .rutaProducto").val(respuesta[0]["ruta"]);
            $("#modalEditarProducto .seleccionarTipo").val(respuesta[0]["tipo"]);


            if(respuesta[0]["tipo"] == "fisico"){
                //$("#modalEditarProducto .multimedia").val(respuesta[0]["multimedia"]);
                if (respuesta[0]["multimedia"] != "") {

                    var imagenesMultimedia = JSON.parse(respuesta[0]["multimedia"]);
    
                    for (var i = 0; i < imagenesMultimedia.length; i++) {
    
                        $(".previsualizarImgFisico").append(
    
                            '<div class="col-md-3">' +
                            '<div class="thumbnail text-center">' +
                            '<img class="imagenesRestantes" src="' + imagenesMultimedia[i].foto + '" style="width:100%">' +
                            '<div class="removerImagen" style="cursor:pointer">Remove file</div>' +
                            '</div>' +
    
                            '</div>'
    
                        );
    
                        localStorage.setItem("multimediaFisica", JSON.stringify(imagenesMultimedia));
    
                    }
    
                    /*=============================================
                    CUANDO ELIMINAMOS UNA IMAGEN DE LA LISTA
                    =============================================*/
    
                    $(".removerImagen").click(function() {
    
                        $(this).parent().parent().remove();
    
                        var imagenesRestantes = $(".imagenesRestantes");
                        var arrayImgRestantes = [];
    
                        for (var i = 0; i < imagenesRestantes.length; i++) {
    
                            arrayImgRestantes.push({ "foto": $(imagenesRestantes[i]).attr("src") })
    
                        }
    
                        localStorage.setItem("multimediaFisica", JSON.stringify(arrayImgRestantes));
    
                    })
    
                }

                var detalles = JSON.parse(respuesta[0]["detalles"]);
    
                $("#modalEditarProducto .detalleAncho").val(detalles.Ancho);
                $("#modalEditarProducto .detalleAlto").val(detalles.Alto);
                $("#modalEditarProducto .detalleLargo").val(detalles.Largo);
                $("#modalEditarProducto .detallePeso").val(detalles.Peso);
                $("#modalEditarProducto .detalleCalibre").val(detalles.Calibre);

            }
            /*=============================================
            TRAEMOS LA CATEGORIA
            =============================================*/

            if (respuesta[0]["id_categoria"] != 0) {

                var datosCategoria = new FormData();
                datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);


                $.ajax({

                    url: "ajax/categorias.ajax.php",
                    method: "POST",
                    data: datosCategoria,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {

                        $("#modalEditarProducto .seleccionarCategoria").val(respuesta["id"]);
                        $("#modalEditarProducto .optionEditarCategoria").html(respuesta["categoria"]);


                    }

                })

            } else {


                $("#modalEditarProducto .optionEditarCategoria").html("SIN CATEGORÍA");

            }

            /*=============================================
            CARGAMOS LA IMAGEN PRINCIPAL
            =============================================*/

            $("#modalEditarProducto .previsualizarPrincipal").attr("src", respuesta[0]["portada"]);
            $("#modalEditarProducto .antiguaFotoPrincipal").val(respuesta[0]["portada"]);

            /*=============================================
						CARGAMOS LA DESCRIPCION
						=============================================*/

            $("#modalEditarProducto .descripcionProducto").val(respuesta[0]["descripcion"]);

            /*=============================================
            CARGAMOS EL PRECIO, PESO Y DIAS DE ENTREGA
            =============================================*/
            $("#modalEditarProducto .precio").val(respuesta[0]["precio"]);
            $("#modalEditarProducto .inventario").val(respuesta[0]["inventario"]);
            $("#modalEditarProducto .entrega").val(respuesta[0]["entrega"]);

            			/*=============================================
			PREGUNTAMOS SI EXITE OFERTA
			=============================================*/

			if(respuesta[0]["oferta"] != 0){

				$("#modalEditarProducto .selActivarOferta").val("oferta");

				$("#modalEditarProducto .datosOferta").show();
				$("#modalEditarProducto .valorOferta").prop("required",true);

				$("#modalEditarProducto .precioOferta").val(respuesta[0]["precioOferta"]);
				$("#modalEditarProducto .descuentoOferta").val(respuesta[0]["descuentoOferta"]);

				if(respuesta[0]["precioOferta"] != 0){

					$("#modalEditarProducto .precioOferta").prop("readonly",true);
					$("#modalEditarProducto .descuentoOferta").prop("readonly",false);

				}

				if(respuesta[0]["descuentoOferta"] != 0){

					$("#modalEditarProducto .descuentoOferta").prop("readonly",true);
					$("#modalEditarProducto .precioOferta").prop("readonly",false);

				}
	
				$("#modalEditarProducto .previsualizarOferta").attr("src", respuesta[0]["imgOferta"]);

				$("#modalEditarProducto .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);
				
				$("#modalEditarProducto .finOferta").val(respuesta[0]["finOferta"]);						

			}else{

				$("#modalEditarProducto .selActivarOferta").val("");
				$("#modalEditarProducto .datosOferta").hide();
				$("#modalEditarProducto .valorOferta").prop("required",false);
				$("#modalEditarProducto .previsualizarOferta").attr("src", "vistas/img/ofertas/default/default.jpg");
				$("#modalEditarProducto .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);

			}

			/*=============================================
			CREAR NUEVA OFERTA AL EDITAR
			=============================================*/

			$("#modalEditarProducto .selActivarOferta").change(function(){

				activarOferta($(this).val())

			})

			$("#modalEditarProducto .valorOferta").change(function(){

				if($(this).attr("tipo") == "oferta"){

					var descuento = 100-(Number($(this).val())*100/Number($("#modalEditarProducto .precio").val()));

					$("#modalEditarProducto .precioOferta").prop("readonly",true);
					$("#modalEditarProducto .descuentoOferta").prop("readonly",false);
					$("#modalEditarProducto .descuentoOferta").val(Math.ceil(descuento));

				}

				if($(this).attr("tipo") == "descuento"){

					var oferta = Number($("#modalEditarProducto .precio").val())-(Number($(this).val())*Number($("#modalEditarProducto .precio").val())/100);	

					$("#modalEditarProducto .descuentoOferta").prop("readonly",true);
					$("#modalEditarProducto .precioOferta").prop("readonly",false);
					$("#modalEditarProducto .precioOferta").val(oferta);

				}

			})

            			/*=============================================
			GUARDAR CAMBIOS DEL PRODUCTO
			=============================================*/	

			var multimediaFisica = null;
			var multimediaVirtual = null;	

			$(".guardarCambiosProducto").click(function(){

					/*=============================================
					PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
					=============================================*/

					if($("#modalEditarProducto .tituloProducto").val() != "" && 
					   $("#modalEditarProducto .seleccionarTipo").val() != "" && 
					   $("#modalEditarProducto .seleccionarCategoria").val() != "" &&
					   $("#modalEditarProducto .descripcionProducto").val() != ""){

						/*=============================================
					   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
					   	=============================================*/

					   	if($("#modalEditarProducto .seleccionarTipo").val() != "virtual"){	

						   	if(arrayFiles.length > 0 && $("#modalEditarProducto .rutaProducto").val() != ""){

						   		var listaMultimedia = [];
						   		var finalFor = 0;

								for(var i = 0; i < arrayFiles.length; i++){
									
									var datosMultimedia = new FormData();
									datosMultimedia.append("file", arrayFiles[i]);
									datosMultimedia.append("ruta", $("#modalEditarProducto .rutaProducto").val());

									$.ajax({
										url:"ajax/productos.ajax.php",
										method: "POST",
										data: datosMultimedia,
										cache: false,
										contentType: false,
										processData: false,
                                        beforeSend: function(){
                                            $(".modal-footer .preload").html(`
            
            
                                            <center>
            
                                                <img src="vistas/img/plantilla/status.gif" id="status" />
                                                <br>
            
                                            </center>
            
                                        `);
                                        },
										success: function(respuesta){
                                            $("#status").remove();
											listaMultimedia.push({"foto" : respuesta.substr(3)});
											multimediaFisica = JSON.stringify(listaMultimedia);
											
											if(localStorage.getItem("multimediaFisica") != null){

												var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));

												var jsonMultimediaFisica = listaMultimedia.concat(jsonLocalStorage);

												multimediaFisica = JSON.stringify(jsonMultimediaFisica);												
											}
																			
											multimediaVirtual = null;

											if(multimediaFisica == null){

												 swal({
												      title: "El campo de multimedia no debe estar vacío",
												      type: "error",
												      confirmButtonText: "¡Cerrar!"
												    });

												 return;
											}
											if((finalFor + 1) == arrayFiles.length){

												editarMiProducto(multimediaFisica);
												finalFor = 0;

											}

											finalFor++;							
								
										}

									})

								}

							}else{
					
								var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));

								multimediaFisica = JSON.stringify(jsonLocalStorage);

								editarMiProducto(multimediaFisica);												
								
							}

						}else{

							multimediaVirtual = $("#modalEditarProducto .multimedia").val();
							multimediaFisica = null;

							if(multimediaVirtual == null){

					 			 swal({
								      title: "El campo de multimedia no debe estar vacío",
								      type: "error",
								      confirmButtonText: "¡Cerrar!"
								    });

					 			  return;
							}	

							editarMiProducto(multimediaVirtual);	
							
						}

					}else{

						 swal({
					      title: "Llenar todos los campos obligatorios",
					      type: "error",
					      confirmButtonText: "¡Cerrar!"
					    });

						return;

					}
			})
        }
    })

})

function editarMiProducto(imagen){
    var idProducto = $("#modalEditarProducto .idProducto").val();
    var tituloProducto = $("#modalEditarProducto .tituloProducto").val();
    var rutaProducto = $("#modalEditarProducto .rutaProducto").val();
    var seleccionarTipo = $("#modalEditarProducto .seleccionarTipo").val();
    var seleccionarCategoria = $("#modalEditarProducto .seleccionarCategoria").val();
    var descripcionProducto = $("#modalEditarProducto .descripcionProducto").val();
    var precio = $("#modalEditarProducto .precio").val();
    var inventario = $("#modalEditarProducto .inventario").val();
    var entrega = $("#modalEditarProducto .entrega").val();
    var selActivarOferta = $("#modalEditarProducto .selActivarOferta").val();
    var precioOferta = $("#modalEditarProducto .precioOferta").val();
    var descuentoOferta = $("#modalEditarProducto .descuentoOferta").val();
    var finOferta = $("#modalEditarProducto .finOferta").val();

    if(seleccionarTipo == "fisico"){
        var detalles = {
            "Ancho": $("#modalEditarProducto .detalleAncho").val(),
            "Largo": $("#modalEditarProducto .detalleLargo").val(),
            "Alto": $("#modalEditarProducto .detalleAlto").val(),
            "Peso": $("#modalEditarProducto .detallePeso").val(),
            "Calibre": $("#modalEditarProducto .detalleCalibre").val()
        };

    }

    var detallesString = JSON.stringify(detalles);

    var antiguaFotoPrincipal = $("#modalEditarProducto .antiguaFotoPrincipal").val();
    var antiguaFotoOferta = $("#modalEditarProducto .antiguaFotoOferta").val();

    var datosProducto = new FormData();
    datosProducto.append("id", idProducto);
    datosProducto.append("editarProducto", tituloProducto);
    datosProducto.append("rutaProducto", rutaProducto);
    datosProducto.append("seleccionarTipo", seleccionarTipo);
    datosProducto.append("detalles", detallesString);
    datosProducto.append("seleccionarCategoria", seleccionarCategoria);
    datosProducto.append("descripcionProducto", descripcionProducto);
    datosProducto.append("precio", precio);
    datosProducto.append("inventario", inventario);
    datosProducto.append("entrega", entrega);

	if(imagen == null){

		multimediaFisica = localStorage.getItem("multimediaFisica");
		datosProducto.append("multimedia", multimediaFisica);

	}else{

		datosProducto.append("multimedia", imagen);
	}	
    datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
    datosProducto.append("selActivarOferta", selActivarOferta);
    datosProducto.append("precioOferta", precioOferta);
    datosProducto.append("descuentoOferta", descuentoOferta);
    datosProducto.append("finOferta", finOferta);
    datosProducto.append("fotoOferta", imagenOferta);
    datosProducto.append("antiguaFotoPrincipal", antiguaFotoPrincipal);
    datosProducto.append("antiguaFotoOferta", antiguaFotoOferta);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datosProducto,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
                                
            
            if(respuesta == "ok"){

                swal({
                  type: "success",
                  title: "El producto ha sido cambiado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                    if (result.value) {

                    localStorage.removeItem("multimediaFisica");
                    localStorage.clear();
                    window.location = "productos";

                    }
                })
            }

        }

})
}
/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$('.tablaProductos tbody').on("click", ".btnEliminarProducto", function(){


  var idProducto = $(this).attr("idProducto");
  var imgOferta = $(this).attr("imgOferta");
  var imgPrincipal = $(this).attr("imgPrincipal");

  swal({
    title: '¿Está seguro de borrar el producto?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar producto!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imgOferta="+imgOferta+"&imgPrincipal="+imgPrincipal;

    }

  })




})