<?php

class ControladorReportes{

    /**Descargar reporte */



	public function ctrDescargarReporte(){



		if(isset($_GET["reporte"])){



			$tabla = $_GET["reporte"];



			$reporte = ModeloReportes::mdlDescargarReporte($tabla);



            $nombre = $_GET["reporte"].'.xls';



            header('Expires: 0');

			header('Cache-control: private');

			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel

			header("Cache-Control: cache, must-revalidate"); 

			header('Content-Description: File Transfer');

			header('Last-Modified: '.date('D, d M Y H:i:s'));

			header("Pragma: public"); 

			header('Content-Disposition:; filename="'.$nombre.'"');

			header("Content-Transfer-Encoding: binary");



            /*=============================================

			REPORTE DE COMPRAS Y VENTAS

			=============================================*/

            if($_GET["reporte"] == "compras"){	



				echo utf8_decode("

					<table border='0'> 

						<tr> 

							<td style='font-weight:bold; border:1px solid #eee;'>Producto</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Cliente</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Pago</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Cantidad</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Estatus del envío</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Forma de pago</td>

							<td style='font-weight:bold; border:1px solid #eee;'>Correo electrónico</td>		

							<td style='font-weight:bold; border:1px solid #eee;'>Direccion</td>		

							<td style='font-weight:bold; border:1px solid #eee;'>Municipio</td>	

							<td style='font-weight:bold; border:1px solid #eee;'>Fecha</td>		

						</tr>");



                        foreach ($reporte as $key => $value) {



                            /*=============================================

                            TRAER PRODUCTO

                            =============================================*/

                            $item = "id";

                            $valor = $value["id_producto"];

        

                            $traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

        

                            /*=============================================

                            TRAER CLIENTE

                            =============================================*/

        

                            $item2 = "id";

                            $valor2 = $value["id_usuario"];

        

                            $traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

        

                             echo utf8_decode("

        

                                 <tr>

                                    <td style='border:1px solid #eee;'>".$traerProducto[0]["titulo"]."</td>

                                    <td style='border:1px solid #eee;'>".$traerCliente["nombre"]."</td>

                                    <td style='border:1px solid #eee;'>$ ".number_format($value["pago"],2)."</td>

									<td style='border:1px solid #eee;'>".$value["cantidad"]."</td>

                                    <td style='border:1px solid #eee;'>

        

                             ");

        

                             /*=============================================

                            TRAER PROCESO DE ENVÍO

                            =============================================*/

                            if($value["envio"] == 0 && $traerProducto[0]["tipo"] == "fisico"){

        

                                $envio ="Despachando el producto";

        

                            }else if($value["envio"] == 1 && $traerProducto[0]["tipo"] == "fisico"){

        

                                $envio = "Enviando el producto";

        

                            }else{

        

                                $envio = "Producto entregado";

        

                            }

        

                             echo utf8_decode($envio."</td>

                                            <td style='border:1px solid #eee;'>".$value["metodo"]."</td>

                                            <td style='border:1px solid #eee;'>

                             ");

        

                          /*=============================================

                            TRAER EMAIL CLIENTE

                            =============================================*/

        

                            // if($value["email"] == ""){

        

                                $email = $traerCliente["email"];

        

                            // }else{

        

                            //     $email = $value["email"];

                            

                            // }

        

                            echo utf8_decode($email."</td>

                                                <td style='border:1px solid #eee;'>".$traerCliente["calle"].", ".$traerCliente["colonia"].", ".$traerCliente["cp"]."</td>

                                                <td style='border:1px solid #eee;'>".$traerCliente["municipio"]."</td>

                                                <td style='border:1px solid #eee;'>".$value["fecha"]."</td>

                                                </tr>"); 		

        

                        }

                

                echo utf8_decode("

                </table>

                ");

            }

            			/*=============================================

			REPORTE DE USUARIOS

			=============================================*/



			if($_GET["reporte"] == "usuarios"){	



				echo utf8_decode("<table border='0'> 



						<tr> 

						<td style='font-weight:bold; border:1px solid #eee;'>Nombre</td> 

						<td style='font-weight:bold; border:1px solid #eee;'>Correo electrónico</td>

						<td style='font-weight:bold; border:1px solid #eee;'>Teléfono</td>

						<td style='font-weight:bold; border:1px solid #eee;'>Dirección</td>

						<td style='font-weight:bold; border:1px solid #eee;'>Modo de registro</td>


						<td style='font-weight:bold; border:1px solid #eee;'>Dirección facturación</td>	

						<td style='font-weight:bold; border:1px solid #eee;'>Razon social</td>	

						<td style='font-weight:bold; border:1px solid #eee;'>RFC</td>	

						<td style='font-weight:bold; border:1px solid #eee;'>CFDI</td>	

						<td style='font-weight:bold; border:1px solid #eee;'>Teléfono de facturación</td>
						
						<td style='font-weight:bold; border:1px solid #eee;'>Correo electrónico de facturación</td>

						<td style='font-weight:bold; border:1px solid #eee;'>Estatus cliente</td>

						<td style='font-weight:bold; border:1px solid #eee;'>Fecha de registro</td>	

						</tr>");



				foreach ($reporte as $key => $value) {



					 echo utf8_decode("<tr>

				 			

				 						<td style='border:1px solid #eee;'>".$value["nombre"]."</td>

				 						<td style='border:1px solid #eee;'>".$value["email"]."</td>

										<td style='border:1px solid #eee;'>".$value["telefono"]."</td>

										<td style='border:1px solid #eee;'>".$value["calle"].", ".$value["colonia"].", ".$value["cp"].", ".$value["municipio"]."</td>

										<td style='border:1px solid #eee;'>".$value["modo"]."</td>

				 						<td style='border:1px solid #eee;'>".$value["calleF"].", ".$value["cpF"].", ".$value["municipioF"].", ".$value["estadoF"]."</td>

										<td style='border:1px solid #eee;'>".$value["razon"]."</td>

										<td style='border:1px solid #eee;'>".$value["rfc"]."</td>

										<td style='border:1px solid #eee;'>".$value["cfdi"]."</td>

										<td style='border:1px solid #eee;'>".$value["telf"]."</td>

										<td style='border:1px solid #eee;'>".$value["emailf"]."</td>

										
									
				 						<td style='border:1px solid #eee;'>");



					 /*=============================================

  					REVISAR ESTADO

  					=============================================*/



		  			if($value["modo"] == "directo"){



			  			if( $value["verificacion"] == 1){

			  				

		  					$estado = "Desactivado";			  			



			  			}else{

			  				

			  				$estado = "Activado";

			  			

			  			}		  			



			  		}else{



			  			$estado = "Activado";



			  		}



				 	echo utf8_decode($estado."</td>

				 					<td style='border:1px solid #eee;'>".$value["fecha"]."</td>

			 					  	 

			 					  </tr>"); 		



				}





			echo "</table>";



			}

        }

    }

}