<?php

class ControladorUsuarios{

    /**REGISTRO DE USUARIOS */

    public function ctrRegistroUsuario(){

        if(isset($_POST["regUsuario"])){



            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&

			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&

			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){



                $encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encriptarEmail = md5($_POST["regEmail"]);


                $datos = array("nombre"=>$_POST["regUsuario"], 

                                "password"=> $encriptar,

                                "email"=>$_POST["regEmail"],

                                "telefono"=>$_POST["regTel"],

                                "modo"=> "directo",

                                "verificacion" => 1,

                                "emailEncriptado" => $encriptarEmail);

               $tabla = "usuarios";

               $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);


               if($respuesta == "ok"){
                   /*=============================================
					ACTUALIZAR NOTIFICACIONES NUEVOS USUARIOS
					=============================================*/

					$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

					$nuevoUsuario = $traerNotificaciones["nuevosUsuarios"] + 1;

					ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevosUsuarios", $nuevoUsuario);



                /**VERIFICACION DE CORREO ELECTRONICO */

                date_default_timezone_set("America/Mexico_City");

                $url = Ruta::ctrRuta();

                $mail = new PHPMailer;

                $mail->CharSet = 'UTF-8';

                $mail->isMail();

                $mail->setFrom('sitioweb@andamiosexpress.com', 'Andamios Express Shop');

                $mail->addReplyTo('sitioweb@andamiosexpress.com', 'Andamios Express Shop');

                $mail->Subject = "Verificación de cuenta en Andamios Express Shop";



                $mail->addAddress($_POST["regEmail"]);

                $mail->msgHTML('

                <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">



                    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: "Lato", Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">

                        </div>

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">

                        <!-- LOGO -->

                        <tr>

                            <td bgcolor="#FFA73B" align="center">

                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                    <tr>

                                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                        <tr>

                            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">

                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                    <tr>

                                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">

                                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">¡Bienvenido!</h1> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                        <tr>

                            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                    <tr>

                                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                            <p style="margin: 0;">Estamos emocionados de que te unas a la familia. Primero, debes confirmar tu cuenta. Simplemente presione el botón de abajo.</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td bgcolor="#ffffff" align="left">

                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                        <table border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B">

                                                                    <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Confirmar

                                                                        correo electrónico</a>

                                                                </td>

                                                            </tr>

                                                        </table>

                                                    </td>

                                                </tr>

                                            </table>

                                        </td>

                                    </tr>



                                    <tr>

                                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                            <p style="margin: 0;">Saludos,<br>Andamios Express Shop</p>

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>



                    </table>

                </body>

                ');



              $envio =  $mail->Send();



              if(!$envio){



                echo '<script>

                swal({

                    title: "Error",

                    text: "Error al enviar confirmacion de correo electronico a '.$_POST["regEmail"].$mail->ErrorInfo.'",

                    type: "error",

                    confirmButtonText: "Cerrar",

                    closeOnConfirm: false

                },

                function(isConfirm) {

                    if(isConfirm){

                        window.location = window.location.href;

                    }

                }

            

            );

                

                

                </script>';



              }else{



                    echo '<script>

                    swal({

                        title: "Registro correcto",

                        text: "Revisa la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].'",

                        type: "success",

                        confirmButtonText: "Cerrar",

                        closeOnConfirm: false

                    },

                    function(isConfirm){

                        if(isConfirm){

                            window.location = window.location.href;

                        }

                    }

                

                );

                    

                    

                    </script>';

                }

            }



            }else{

                echo '<script>

                swal({

                    title: "Error",

                    text: "Error al registrar el usuario, no se permiten caracteres especiales o campos vacíos.",

                    type: "error",

                    confirmButtonText: "Cerrar",

                    closeOnConfirm: false

                },

                function(isConfirm){

                    if(isConfirm){

                        window.location = window.location.href;

                    }

                }

            

            );

                

                

                </script>';

            }



        }

    }



    /**MOSTRAR USUARIO */



   static public function ctrMostrarUsuario($item, $valor){

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

        return $respuesta;

    }



	/*=============================================

	ACTUALIZAR USUARIO

	=============================================*/



	static public function ctrActualizarUsuario($id, $item, $valor){



		$tabla = "usuarios";



		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);



		return $respuesta;



	}



    /**INGRESO DE USUARIOS */



    public function ctrIngresoUsuario(){



        if(isset($_POST["ingEmail"])){



            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&

            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){



                $encriptar = crypt($_POST["ingPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item = "email";

                $valor = $_POST["ingEmail"];



                $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);



                if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){



                    if($respuesta["verificacion"] == 1){

                        echo '<script>

                        swal({

                            title: "Error al ingresar",

                            text: "Debe verificar su cuenta, revise su bandeja de entrada o de SPAM de '.$respuesta[0]["email"].'",

                            type: "error",

                            confirmButtonText: "Cerrar",

                            closeOnConfirm: false

                        },

                        function(isConfirm){

                            if(isConfirm){

                                window.location = window.location.href;

                            }

                        }

                    

                    );

                        

                        

                        </script>';



                    }else{

                        $_SESSION["validarSesion"] = "ok";

                        $_SESSION["id"] = $respuesta["id"];

                        $_SESSION["nombre"] = $respuesta["nombre"];

                        $_SESSION["foto"] = $respuesta["foto"];

                        $_SESSION["email"] = $respuesta["email"];

                        $_SESSION["telefono"] = $respuesta["telefono"];

                        $_SESSION["password"] = $respuesta["password"];

                        $_SESSION["modo"] = $respuesta["modo"];



                        echo'

                        <script>

                            window.location = localStorage.getItem("rutaActual");

                        

                        </script>

                        ';





                    }



                }else{



                    echo '<script>

                    swal({

                        title: "Error",

                        text: "Error al ingresar, el correo o contraseña no coinciden.",

                        type: "error",

                        confirmButtonText: "Cerrar",

                        closeOnConfirm: false

                    },

                    function(isConfirm){

                        if(isConfirm){

                            window.location = localStorage.getItem("rutaActual");

                        }

                    }

                

                );

                    

                    

                    </script>';





                }


            }else{



                echo '<script>

                swal({

                    title: "Error",

                    text: "Error al ingresar, no se permiten caracteres especiales o campos vacíos.",

                    type: "error",

                    confirmButtonText: "Cerrar",

                    closeOnConfirm: false

                },

                function(isConfirm){

                    if(isConfirm){

                        window.location = window.location.href;

                    }

                }

            

            );

                </script>';



            }



        }

    }

/**OLVIDO DE CONTRASEÑA */



public function ctrOlvidoPassword(){



    if(isset($_POST["passEmail"])){



        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){

            /**GENERAR PASS ALEATORIA */



            function generarPassword($longitud){

                $key = "";

                $pattern ="1234567890abcdefghijklmnopqrstuvwxyz";



                $max = strlen($pattern)-1;



                for($i = 0; $i < $longitud; $i++){

                    $key .= $pattern[mt_rand(0,$max)];



                }

                return $key;

            }



            $nuevaPassword =  generarPassword(11);

            $encriptar= crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $tabla = "usuarios";

            $item1 = "email";

            $valor1 = $_POST["passEmail"];

            $respuesta1 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item1, $valor1);



            if($respuesta1){



                $id = $respuesta1["id"];

                $item2 = "password";

                $valor2 = $encriptar;



                $respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item2, $valor2);



                if($respuesta2 == "ok"){



                    /**VERIFICACION DE nueva contase;a */

    

                    date_default_timezone_set("America/Mexico_City");

    

                    $url = Ruta::ctrRuta();

    

                    $mail = new PHPMailer;

                    $mail->CharSet = 'UTF-8';

                    $mail->isMail();

                    $mail->setFrom('sitioweb@andamiosexpress.com', 'Andamios Express Shop');

                    $mail->addReplyTo('sitioweb@andamiosexpress.com', 'Andamios Express Shop');

                    $mail->Subject = "Solicitud de nueva contraseña en Andamios Express Shop";

    

                    $mail->addAddress($_POST["passEmail"]);

    

                    $mail->msgHTML('

                    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: "Lato", Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">

		            </div>

                        <table border="0" cellpadding="0" cellspacing="0" width="100%">

                            <!-- LOGO -->

                            <tr>

                                <td bgcolor="#FFA73B" align="center">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>

                                        </tr>

                                    </table>

                                </td>

                            </tr>

                            <tr>

                                <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">

                                                <img src="https://img.icons8.com/clouds/100/000000/lock-2.png" width="125" height="120" style="display: block; border: 0px;" /><h1 style="font-size: 28px; font-weight: 400; margin: 2; text-transform: capitalize;">SOLICITUD DE NUEVA CONTRASEÑA</h1> 

                                            </td>

                                        </tr>

                                    </table>

                                </td>

                            </tr>

                            <tr>

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; text-align:center;">

                                                <p style="margin: 0;"><strong>Nueva contraseña:</strong>'.$nuevaPassword.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B">

                                                                        <a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Regresar al sitio</a>

                                                                    </td>

                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>

                                                </table>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">Saludos,<br>Andamios Express Shop</p>

                                            </td>

                                        </tr>

                                    </table>

                                </td>

                            </tr>



                        </table>



                    ');

    

                  $envio =  $mail->Send();

    

                  if(!$envio){

    

                    echo '<script>

                    swal({

                        title: "Error",

                        text: "Ha ocurrido un error al intentar cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'",

                        type: "error",

                        confirmButtonText: "Cerrar",

                        closeOnConfirm: false

                    },

                    function(isConfirm){

                        if(isConfirm){

                            window.location = window.location.href;

                        }

                    }

                

                );

                    

                    

                    </script>';

    

                  }else{

    

                        echo '<script>

                        swal({

                            title: "Solicitud correcta",

                            text: "Revisa la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para seguir el proceso de cambio de contraseña",

                            type: "success",

                            confirmButtonText: "Cerrar",

                            closeOnConfirm: false

                        },

                        function(isConfirm){

                            if(isConfirm){

                                window.location = window.location.href;

                            }

                        }

                    

                    );

                        

                        

                        </script>';

                    }

                }



            }else{

                echo '<script>

            swal({

                title: "Error",

                text: "El correo ingresado no coincide con los registros en el sistema",

                type: "error",

                confirmButtonText: "Cerrar",

                closeOnConfirm: false

            },

            function(isConfirm){

                if(isConfirm){

                    window.location = window.location.href;

                }

            }

        

        );

        
            </script>';


            }

       

        }else{



            echo '<script>

            swal({

                title: "Error",

                text: "Error al enviar el correo electrónico, escribe un correo valido.",

                type: "error",

                confirmButtonText: "Cerrar",

                closeOnConfirm: false

            },

            function(isConfirm){

                if(isConfirm){

                    window.location = window.location.href;

                }

            }

        

        );
       

            </script>';



        }

    }

}



/**ACTUALIZAR PERFIL */



    public function ctrActualizarPerfil(){


        if(isset($_POST["editarNombre"])){

        /**Validar   foto */

        $ruta = $_POST["fotoUsuario"];



        if(isset($_FILES["datosImagen"]["tmp_name"]) && !empty($_FILES["datosImagen"]["tmp_name"])){

            /**comprobar existencia de imagen */



            $directorio = "vistas/img/usuarios/".$_POST["idUsuario"];



            if(!empty($_POST["fotoUsuario"])){

                unlink($_POST["fotoUsuario"]);

            }else{

                mkdir($directorio, 0755);

            }

            /**Guardar de imagen */

            list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);



            $nuevoAncho = 500;

            $nuevoAlto = 500;



            if($_FILES["datosImagen"]["type"] == "image/jpeg"){



                /**nombre aleatorio */

                $aleatorio = mt_rand(100,999);



                $ruta = "vistas/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";



                /**Tamano de imagen */


                $origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);



                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



                imagejpeg($destino, $ruta);

            }

            if($_FILES["datosImagen"]["type"] == "image/png"){



                /**nombre aleatorio */

                $aleatorio = mt_rand(100,999);



                $ruta = "vistas/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".png";



                /**Tamano de imagen */


                $origen = imagecreatefrompng($_FILES["datosImagen"]["tmp_name"]);



                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                /**Guardar transparencias del png */

                imagealphablending($destino, FALSE);

                imagesavealpha($destino, TRUE);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                imagepng($destino, $ruta);

            }

        }


            if($_POST["editarPassword"] == ""){

                $password = $_POST["passUsuario"];

            }else{

                $password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            }

            $datos = array("nombre" => $_POST["editarNombre"],

                            "email" => $_POST["editarEmail"],

                            "telefono" => $_POST["editarTelefono"],

                            "password" => $password,

                            "foto" => $ruta,

                            "id" => $_POST["idUsuario"] );

            $tabla = "usuarios";



            $respuesta = ModeloUsuarios::mdlActualizarPerfil($tabla, $datos);



            if($respuesta == "ok"){



                $_SESSION["validarSesion"] = "ok";

                $_SESSION["id"] = $datos["id"];

                $_SESSION["nombre"] = $datos["nombre"];

                $_SESSION["foto"] = $datos["foto"];

                $_SESSION["email"] = $datos["email"];

                $_SESSION["telefono"] = $datos["telefono"];

                $_SESSION["password"] = $datos["password"];

                $_SESSION["modo"] = $_POST["modoUsuario"];



				echo '<script> 



						swal({

							  title: "¡OK!",

							  text: "¡Su cuenta ha sido actualizada correctamente!",

							  type:"success",

							  confirmButtonText: "Cerrar",

							  closeOnConfirm: false

							},



							function(isConfirm){



								if(isConfirm){

									window.location = "perfil";

								}

						});

               



				</script>';



            }else{



            }

        }

    }

    public function ctrActualizarDireccion(){

        if(isset($_POST["editarCalle"])){


            $datos = array(

            "calle" => $_POST["editarCalle"],

            "colonia" => $_POST["editarColonia"],

            "cp" => $_POST["editarCp"],

            "municipio" => $_POST["editarMunicipio"],

            "id" => $_POST["idUsuario"] );

            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlActualizarDireccion($tabla, $datos);


            if($respuesta == "ok"){



                $_SESSION["validarSesion"] = "ok";

                $_SESSION["id"] = $datos["id"];

                $_SESSION["calle"] = $datos["calle"];

                $_SESSION["colonia"] = $datos["colonia"];

                $_SESSION["cp"] = $datos["cp"];

                $_SESSION["municipio"] = $datos["municipio"];

				echo '<script> 



						swal({

							  title: "¡OK!",

							  text: "¡Su dirección ha sido actualizada correctamente!",

							  type:"success",

							  confirmButtonText: "Cerrar",

							  closeOnConfirm: false

							},



							function(isConfirm){



								if(isConfirm){

									window.location = "carrito-de-compras";

								}

						});

               



				</script>';



            }else{



            }

        }
    }
    public function ctrActualizarDireccionP(){

        if(isset($_POST["editarCalle"])){


            $datos = array(

            "calle" => $_POST["editarCalle"],

            "colonia" => $_POST["editarColonia"],

            "cp" => $_POST["editarCp"],

            "municipio" => $_POST["editarMunicipio"],

            "id" => $_POST["idUsuario"] );

            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlActualizarDireccion($tabla, $datos);


            if($respuesta == "ok"){



                $_SESSION["validarSesion"] = "ok";

                $_SESSION["id"] = $datos["id"];

                $_SESSION["calle"] = $datos["calle"];

                $_SESSION["colonia"] = $datos["colonia"];

                $_SESSION["cp"] = $datos["cp"];

                $_SESSION["municipio"] = $datos["municipio"];

				echo '<script> 



						swal({

							  title: "¡OK!",

							  text: "¡Su dirección ha sido actualizada correctamente!",

							  type:"success",

							  confirmButtonText: "Cerrar",

							  closeOnConfirm: false

							},



							function(isConfirm){



								if(isConfirm){

									window.location = "perfil";

								}

						});

                



				</script>';



            }else{



            }

        }
    }
    public function ctrActualizarFacturacion(){

        if(isset($_POST["editarRazon"])){


            $datos = array(

            "razon" => $_POST["editarRazon"],

            "calleF" => $_POST["editarCalleFacturacion"],

            "cpF" => $_POST["editarCpFacturacion"],

            "municipioF" => $_POST["editarMunicipioFacturacion"],

            "estadoF" => $_POST["editarEstadoFacturacion"],

            "rfc" => $_POST["editarRFC"],

            "cfdi" => $_POST["editarCFDI"],

            "telf" => $_POST["editarTelefonoFacturacion"],

            "emailf" => $_POST["editarMailFacturacion"],

           
           

            "id" => $_POST["idUsuario"] );

            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlActualizarFacturacion($tabla, $datos);


            if($respuesta == "ok"){



                $_SESSION["validarSesion"] = "ok";

                $_SESSION["id"] = $datos["id"];

                // $_SESSION["calle"] = $datos["calle"];

                // $_SESSION["colonia"] = $datos["colonia"];

                // $_SESSION["cp"] = $datos["cp"];

                // $_SESSION["municipio"] = $datos["municipio"];

				echo '<script> 



						swal({

							  title: "¡OK!",

							  text: "¡Su información ha sido actualizada correctamente!",

							  type:"success",

							  confirmButtonText: "Cerrar",

							  closeOnConfirm: false

							},



							function(isConfirm){



								if(isConfirm){

									window.location = "carrito-de-compras";

								}

						});

                window.location = "perfil";



				</script>';



            }else{



            }

        }
    }

    /**MOSTRAR COMPRAS */



    static public function ctrMostrarCompras($item, $valor){



        $tabla = "compras";

        $respuesta = ModeloUsuarios::mdlMostrarCompras($tabla, $item, $valor);

        return $respuesta;

    }

        /**MOSTRAR COMPRAS */


        static public function ctrMostrarComprasTransferencia($item, $valor){

            $tabla = "ventas";
    
            $respuesta = ModeloUsuarios::mdlMostrarCompras ($tabla, $item, $valor);
    
            return $respuesta;
    
        }



    /**ELIMINAR USUARIO */



    public function ctrEliminarUsuario(){



        if(isset($_GET["id"])){

            $tabla1 = "usuarios";

            $tabla2 = "compras";



            $id = $_GET["id"];



            if($_GET["foto"] != ""){



				unlink($_GET["foto"]);

				rmdir('vistas/img/usuarios/'.$_GET["id"]);



			}



            $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla1, $id);

	

			ModeloUsuarios::mdlEliminarCompras($tabla2, $id);



            if($respuesta == "ok"){



		    	$url = Ruta::ctrRuta();



		    	echo'<script>



						swal({

							  title: "¡SU CUENTA HA SIDO BORRADA!",

							  text: "¡Debe registrarse nuevamente si desea ingresar!",

							  type: "success",

							  confirmButtonText: "Cerrar",

							  closeOnConfirm: false

						},



						function(isConfirm){

								 if (isConfirm) {	   

								   window.location = "'.$url.'salir";

								  } 

						});

                        window.location = "'.$url.'salir";



					  </script>';



		    }



        }

    }



}