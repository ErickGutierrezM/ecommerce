/*=============================================
CAMBIAR INFORMACIÓN
=============================================*/

var impuesto = $("#impuesto").val();
var envioNacional = $("#envioNacional").val();
var envioInternacional = $("#envioInternacional").val();
var tasaMinimaNal = $("#tasaMinimaNal").val();
var tasaMinimaInt = $("#tasaMinimaInt").val();
var clienteIdPaypal = $("#clienteIdPaypal").val();
var llaveSecretaPaypal = $("#llaveSecretaPaypal").val();


/*=============================================
CAMBIAR MODO PAYPAL
=============================================*/
$("input[name='modoPaypal']").on("ifChecked",function(){

	var modoPaypal = $(this).val();
	cambiarInformacion(modoPaypal);

})


/*=============================================
GUARDAR LA INFORMACION
=============================================*/

$(".cambioInformacion").change(function(){

	impuesto = $("#impuesto").val();

	envioNacional = $("#envioNacional").val();

	envioInternacional = $("#envioInternacional").val();

	tasaMinimaNal = $("#tasaMinimaNal").val();

	tasaMinimaInt = $("#tasaMinimaInt").val();

	seleccionarPais = $("#seleccionarPais").val();

	modoPaypal = $("input[name='modoPaypal']:checked").val();

	clienteIdPaypal = $("#clienteIdPaypal").val();

	llaveSecretaPaypal = $("#llaveSecretaPaypal").val();


	$("#guardarInformacion").click(function(){

		cambiarInformacion();
	
	})	

})

/*=============================================
// FUNCIÓN PARA CAMBIAR LA INFORMACIÓN
=============================================*/

function cambiarInformacion(modoPaypal){
	console.log(modoPaypal);

	// var datos = new FormData();
	// datos.append("impuesto", impuesto);
	// datos.append("envioNacional", envioNacional);
	// datos.append("envioInternacional", envioInternacional);
	// datos.append("tasaMinimaNal", tasaMinimaNal);
	// datos.append("tasaMinimaInt", tasaMinimaInt);
	// datos.append("seleccionarPais", seleccionarPais);
	// datos.append("modoPaypal", modoPaypal);	
	// console.log(modoPaypal);
	// datos.append("clienteIdPaypal", clienteIdPaypal);
	// datos.append("llaveSecretaPaypal", llaveSecretaPaypal);

	// $.ajax({

	// 	url:"ajax/comercio.ajax.php",
	// 	method: "POST",
	// 	data: datos,
	// 	cache: false,
	// 	contentType: false,
	// 	processData: false,
	// 	success: function(respuesta){
	// 		console.log("respuesta",respuesta);

			
	// 		// if(respuesta == "ok"){

	// 		// 	swal({
	// 		//       title: "Cambios guardados",
	// 		//       text: "¡Los datos han sido actualizado correctamente!",
	// 		//       type: "success",
	// 		//       confirmButtonText: "¡Cerrar!"
	// 		//     });
			
	// 		// }
							
	// 	}

	// })

}