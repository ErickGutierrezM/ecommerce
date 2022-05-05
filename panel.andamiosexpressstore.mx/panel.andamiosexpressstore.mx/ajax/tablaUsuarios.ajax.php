<?php



require_once "../controladores/usuarios.controlador.php";

require_once "../modelos/usuarios.modelo.php";

require_once "../modelos/rutas.php";



class TablaUsuarios{



 	/*=============================================

  	MOSTRAR LA TABLA DE USUARIOS

  	=============================================*/ 



	public function mostrarTabla(){	



		$item = null;

 		$valor = null;



 		$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		$url = Ruta::ctrRuta();



 		$datosJson = '{

		 

	 	"data": [ ';



	 	for($i = 0; $i < count($usuarios); $i++){



	 		/*=============================================
			TRAER FOTO USUARIO
			=============================================*/

			if($usuarios[$i]["foto"] != "" ){

				$foto = "<img class='img-circle' src='".$url.$usuarios[$i]["foto"]."' width='60px'>";

			}else{

				$foto = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='60px'>";
			}



			/*=============================================

  			REVISAR ESTADO

  			=============================================*/



  			if($usuarios[$i]["modo"] == "directo"){



	  			if( $usuarios[$i]["verificacion"] == 1){



	  				$colorEstado = "btn-danger";

	  				$textoEstado = "Desactivado";

	  				$estadoUsuario = 0;



	  			}else{



	  				$colorEstado = "btn-success";

	  				$textoEstado = "Activado";

	  				$estadoUsuario = 1;



	  			}



	  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idUsuario='". $usuarios[$i]["id"]."' estadoUsuario='".$estadoUsuario."'>".$textoEstado."</button>";



	  		}else{



	  			$estado = "<button class='btn btn-xs btn-info'>Activado</button>";



	  		}





	 		/*=============================================

			DEVOLVER DATOS JSON

			=============================================*/



			$datosJson	 .= '[

				      "'.($i+1).'",

				      "'.$usuarios[$i]["nombre"].'",

				      "'.$usuarios[$i]["email"].'",

					  "'.$usuarios[$i]["telefono"].'",

					  "'.$usuarios[$i]["calle"].', '.$usuarios[$i]["colonia"].', '.$usuarios[$i]["cp"].', '.$usuarios[$i]["municipio"].'",

				      "'.$foto.'",

				      "'.$estado.'",

					  "'.$usuarios[$i]["calleF"].', '.$usuarios[$i]["cpF"].', '.$usuarios[$i]["municipioF"].', '.$usuarios[$i]["estadoF"].'",

					  "'.$usuarios[$i]["razon"].'",

					  "'.$usuarios[$i]["rfc"].'",

					  "'.$usuarios[$i]["cfdi"].'",

					  "'.$usuarios[$i]["telf"].'",

					  "'.$usuarios[$i]["emailf"].'",

				      "'.$usuarios[$i]["fecha"].'"    

				    ],';



	 	}



	 	$datosJson = substr($datosJson, 0, -1);



		$datosJson.=  ']

			  

		}'; 



		echo $datosJson;



 	}



}



/*=============================================

ACTIVAR TABLA DE VENTAS

=============================================*/ 

$activar = new TablaUsuarios();

$activar -> mostrarTabla();







