<?php



class ControladorVentas{

	/*=============================================

	MOSTRAR TOTAL VENTAS

	=============================================*/



	static public function ctrMostrarTotalVentas(){



		$tabla = "compras";



		$respuesta = ModeloVentas::mdlMostrarTotalVentas($tabla);



		return $respuesta;



	}



	/*=============================================

	MOSTRAR VENTAS

	=============================================*/



	static	public function ctrMostrarVentas(){



		$tabla = "compras";



		$respuesta = ModeloVentas::mdlMostrarVentas($tabla);



		return $respuesta;

    }



	/*=============================================

	MOSTRAR VENTAS

	=============================================*/



	static	public function ctrMostrarCompras(){



		$tabla = "ventas";



		$respuesta = ModeloVentas::mdlMostrarCompras($tabla);



		return $respuesta;

    }



		/*=============================================

	REGISTRAR VENTAS

	=============================================*/



	static public function ctrCrearVenta(){



		if(isset($_POST["listaProductos"])){

			/**Aumentar las ventas de los productos */



			$listaProductos = json_decode($_POST["listaProductos"], true); 



			// var_dump($listaProductos);

			foreach($listaProductos as $key => $value){

				$tablaProductos = "productos";



				$item = "id";

				$valor = $value["id"];



				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				//var_dump($traerProducto[0]["ventas"]);



				$item1a = "ventas";

				$valor1a = $value["cantidad"] + $traerProducto[0]["ventas"];



				//$nuevasVentas = ModeloProductos::mdlActualizarProductos($tablaProductos, $item, $valor);



				/**guardar compra */



				$tabla = "ventas";

				$datos = array("id_usuario"=>$_POST["seleccionarCliente"],								

								"productos"=>$_POST["listaProductos"],

								"impuesto"=>$_POST["nuevoPrecioImpuesto"],

								"neto"=>$_POST["nuevoPrecioNeto"],

								"total"=>$_POST["totalVenta"],

								"metodo_pago"=>$_POST["listaMetodoPago"]);



				$respuesta = ModeloVentas::mdlingresarVenta($tabla, $datos);



				if($respuesta == "ok"){



					echo'<script>

	

					localStorage.removeItem("rango");

	

					swal({

						  type: "success",

						  title: "La venta ha sido guardada correctamente",

						  showConfirmButton: true,

						  confirmButtonText: "Cerrar"

						  }).then((result) => {

									if (result.value) {

	

									window.location = "ventas-transferencia";

	

									}

								})

	

					</script>';

	

				}





			}

		}



	}



}