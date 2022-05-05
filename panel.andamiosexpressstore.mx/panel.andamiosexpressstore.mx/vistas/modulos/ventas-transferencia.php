<div class="content-wrapper">



  <section class="content-header">

    

  <h1>Gestor de ventas con transferencia bancaria</h1>




    <ol class="breadcrumb">

      

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      

      <li class="active">Gestor de ventas con transferencia bancaria</li>

    

    </ol>



  </section>



  <section class="content">



    <div class="box">







      <div class="box-body">
        

  

       <table class="table table-bordered table-striped dt-responsive tablas">

         

        <thead>

         

         <tr>

           

           <th style="width:10px">#</th>

           <th>Cliente</th>

           <th>Correo electrónico</th>

           <th>Teléfono</th>

           <th>Dirección</th>

           <th>Productos</th>

           <th># transferencia</th>

           <th>Estatus de envio</th>

           <th>Estatus del pago</th>

           <th>Total</th> 

           <th>Fecha</th>

           



         </tr> 



        </thead>



        <tbody>



        <?php



            $item = null;

            $valor = null;

            $respuesta = ControladorVentas::ctrMostrarCompras($item, $valor);





            foreach ($respuesta as $key => $value) {



                echo'

                    <tr>



                        <td>'.($key+1).'</td>';



                        $itemCliente = "id";

                        $valorCliente = $value["id_usuario"];



                        $respuestaCliente = ControladorUsuarios::ctrMostrarUsuarios($itemCliente, $valorCliente);



                        $calle = $respuestaCliente["calle"];

                        $colonia = $respuestaCliente["colonia"];

                        $cp = $respuestaCliente["cp"];

                        $municipio = $respuestaCliente["municipio"];

                    

                        echo'



                        <td>'.$respuestaCliente["nombre"].'</td>



                        <td>'.$respuestaCliente["email"].'</td>

                        <td>'.$respuestaCliente["telefono"].'</td>

                        <td>'.$calle.", ".$colonia.", ".$cp." ".$municipio.'</td>';



                        $ventas = json_decode($respuesta[$key]["productos"],true);



                        foreach ($ventas as $keyVentas => $valueVentas) {

                            $productos.=("<ul> <li>".$valueVentas["titulo"]."</li></ul>");

                        }

                        

                        echo'

                        <td>'.$productos.'</td>



                        <td>'.$value["metodo_pago"].'</td>';



                    /*=============================================

                    TRAER PROCESO DE ENVÍO

                    =============================================*/

                    if($value["envio"] == 0){



                        $envio ="<button class='btn btn-danger btn-xs btnEnvio' idVentaTransferencia='".$value["id"]."' etapa='1'>Despachando el producto</button>";



                    }else if($value["envio"] == 1){



                        $envio = "<button class='btn btn-warning btn-xs btnEnvio' idVentaTransferencia='".$value["id"]."' etapa='2'>Enviando el producto</button>";



                    }else{



                        $envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";



                    }



                        echo'



                        <td>'.$envio.'</td>';



                    /**ESTATUS DE PAGO */

                    if($value["estatus_pago"] == 0){



                        $pago ="<button class='btn btn-info btn-xs btnProceso' idPagoVentaTransferencia='".$value["id"]."' etapa='1'>Pago recibido</button>";



                    }else if($value["estatus_pago"] == 1){



                        $pago = "<button class='btn btn-warning btn-xs btnProceso' idPagoVentaTransferencia='".$value["id"]."' etapa='2'>Verificación del pago</button>";



                    }else{



                        $pago = "<button class='btn btn-success btn-xs'>Pago aprobado</button>";



                    }





                        echo'



                        <td>'.$pago.'</td>



                        <td>$ '.number_format($value["total"],2).'</td>



                        <td>'.$value["fecha"].'</td>



                    </tr>

            

            ';

            }



        

        ?>

        

          

        </tbody>



       </table>



      </div>



    </div>



  </section>



</div>



