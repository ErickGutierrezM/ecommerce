<!--VERIFICAR-->

<?php



    $usuarioVerificado = false;

    $item= "emailEncriptado";



    $valor = $rutas[1];



    $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);



    if(is_array($respuesta)){

 

		if($valor == $respuesta["emailEncriptado"]){

 

			$id = $respuesta["id"];

			$item2 = "verificacion";

			$valor2 = 0;

			$respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id, $item2, $valor2);

	

			if($respuesta2 == "ok"){

				$usuarioVerificado = true;

			}

	

		}

 

	}else{

 

		$usuarioVerificado = false;

 

	}



    



?>

<div class="jumbotron text-center">

<?php

    if($usuarioVerificado){

        echo'

            <h1 class="display-3">GRACIAS POR VERFICAR SU CUENTA</h1>

            <p class="lead"><strong>Hemos verificado su correo</strong> ya puede ingresar al sistema.</p>


            </div>';

    }else{

        echo'

        <h1 class="display-3">Ha habido un error con tu cuenta</h1>

        <p class="lead"><strong>Lo sentimos</strong> no se ha podido verificar su cuenta, vuelva a registrarse.</p>

        <hr>

        <p class="lead">

            <a class="btn btn-primary btn-sm" href="#modalRegistro" role="button">Registro</a>

        </p>

        </div>';

    }

?>

<!--<p class="lead">

<a class="btn btn-primary btn-sm" href="#modalIngreso" role="button">Ingresar</a>

</p>-->