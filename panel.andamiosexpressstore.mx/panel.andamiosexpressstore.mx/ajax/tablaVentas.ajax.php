<?php



require_once "../modelos/rutas.php";

require_once "../controladores/ventas.controlador.php";

require_once "../modelos/ventas.modelo.php";



require_once "../controladores/productos.controlador.php";

require_once "../modelos/productos.modelo.php";



require_once "../controladores/usuarios.controlador.php";

require_once "../modelos/usuarios.modelo.php";



class TablaVentas{

    /**MOSTRAR TABLA VENTAS */



        public function mostrarTabla(){



            $ventas = ControladorVentas::ctrMostrarVentas();

            $url = Ruta::ctrRuta();



            $datosJson = '{ 

                "data": [';

                for($i = 0; $i < count($ventas); $i++){

                    /**traer producto*/

                    $item = "id";

                    $valor = $ventas[$i]["id_producto"];



                    $traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

                    

                   

                    $producto = $traerProducto[0]["titulo"];

                    // $productos = json_decode($traerProducto[0],true);

                    $imgProducto = "<img class='img-thumbnail' src='".$traerProducto[0]["portada"]."' width='100px'>";

                    $tipo = $traerProducto[0]["tipo"];



                    /**traer cliente*/

                    $item2 = "id";

                    $valor2 = $ventas[$i]["id_usuario"];



                    $traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

                    $cliente = $traerCliente["nombre"];



                    if($traerCliente["foto"] != ""){



                        $imgCliente = "<img class='img-circle' src='".$url.$traerCliente["foto"]."' width='70px'>";

            

                    }else{

            

                        $imgCliente = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='70px'>";

                    }

            

                    /**TRAER EMAIL CLIENTE */

                    // if($ventas[$i]["email"] == ""){

                        $email = $traerCliente["email"];

                    // }else{

                    //     $email = $ventas[$i]["email"];

                    // }



                    /**TRAER DIRECCION  */



                    $calle = $traerCliente["calle"];

                    $colonia = $traerCliente["colonia"];

                    $cp = $traerCliente["cp"];

                    $municipio = $traerCliente["municipio"];



                    $telefono = $traerCliente["telefono"];

                    /*=============================================

                    TRAER PROCESO DE ENVÍO

                    =============================================*/

                    if($ventas[$i]["envio"] == 0){



                        $envio ="<button class='btn btn-danger btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='1'>Despachando el producto</button>";



                    }else if($ventas[$i]["envio"] == 1){



                        $envio = "<button class='btn btn-warning btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='2'>Enviando el producto</button>";



                    }else{



                        $envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";



                    }

                    



                    /**ESTATUS DE PAGO */





                    if($ventas[$i]["estatus_pago"] == 0){



                        $pago ="<button class='btn btn-info btn-xs btnProceso' idPagoVenta='".$ventas[$i]["id"]."' etapa='1'>Pago recibido</button>";



                    }else if($ventas[$i]["estatus_pago"] == 1){



                        $pago = "<button class='btn btn-warning btn-xs btnProceso' idPagoVenta='".$ventas[$i]["id"]."' etapa='2'>Verificación del pago</button>";



                    }else{



                        $pago = "<button class='btn btn-success btn-xs'>Pago aprobado</button>";



                    }


                    if($ventas[$i]["metodo"] == "paypal"){



                        $metodo = "<img class='img-responsive' src='vistas/img/plantilla/paypal.jpg' width='300px'>";

                    

                    }else{



                        $metodo = $ventas[$i]["metodo"];



                    }



                    // "$ '.number_format($ventas[$i]["pago"],2).'",



                    /**devolver datos json*/



                    $datosJson .='[

                                    "'.($i+1).'",

                                    "'.$producto.'",

                                    "'.$imgProducto.'",

                                    "$ '.number_format($ventas[$i]["pago"],2).'",
                                    "'.$ventas[$i]["cantidad"].'",

                                    "'.$envio.'",

                                    "'.$pago.'",

                                    "'.$metodo.'",

                                    "'.$cliente.'",

                                    "'.$imgCliente.'",

                                    "'.$email.'",

                                    "'.$calle.", ".$colonia.", ".$cp." ".$municipio.'",

                                    "'.$telefono.'",

                                    "'.$ventas[$i]["fecha"].'"

                                    ],';



                }

                $datosJson = substr($datosJson, 0, -1);

                $datosJson.= ']

                }';



            echo $datosJson;



        }

}



/**ACTIVAR TABLA VENTAS */



$activar = new TablaVentas();

$activar -> mostrarTabla();