<?php
$url = Ruta::ctrRuta();
?>

<div class="container-fluid">
    <div class="container">

        <div class="row">

            <div class="col-xs-12">

                <nav class="bg-bread" aria-label="breadcrumb">

                    <ol class="breadcrumb text-capitalize">

                        <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Carrito de compras</a></li>

                        <li class="breadcrumb-item active pagAct" aria-current="page"><?php echo $rutas[0]; ?></li>

                    </ol>

                </nav>

            </div>

        </div>

    </div>
</div>

<!--CARRITO DE COMPRAS-->

<div class="container-fluid">

    <div class="container">

    <div id="capture">
        <!-- Shopping Cart-->
        <div class="table-responsive shopping-cart" >

            <table class="table">

                <thead>

                    <tr>

                        <th>Producto</th>

                        <th class="text-center">Precio</th>

                        <th class="text-center">Cantidad</th>

                        <th class="text-center">Subtotal</th>

                        <th class="text-center"></th>

                    </tr>

                </thead>

                <tbody class="cuerpoCarrito">
                <table id="referencias"></table>
                <table id="indicaciones"></table>
                <table id="agradecimiento"></table>

                </tbody>

            </table>

        </div>

        <div class="shopping-cart-footer sumaCarrito">
            <div class="card ml-auto border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <p class="mr-1">Total: </p>
                        </div>
                        <div class="col-xs-6">
                            <h4 class="sumaSubTotal">

                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <div class="shopping-cart-footer cabeceraCheckout">

            <div class="container">
                <div class="row">
                    <div class="col-sm-8">

                        <div class="card w-100 border-0 p-1">
                            <?php
                            $username = "andamio8_admin";
                            $password = "AES%2021#F";
                            $database = "andamio8_ecommerce";

                            $mysqli = new mysqli("localhost:3306", $username, $password, $database);
                            

                            $sql = mysqli_query( $mysqli, "SELECT * FROM usuarios WHERE id = '".$_SESSION["id"]."'");
                            $result_f = mysqli_fetch_array($sql);
                            //var_dump($result_f);
                            //var_dump($result_f [7], $result_f[8], $result_f[9], $result_f[10]);
                            $calle = $result_f [7];
                            $colonia = $result_f[8];
                            $cp = $result_f[9];
                            $municipio = $result_f[10];

                            $direccion = $calle.', '.$colonia.', '.$cp.' '.$municipio;
                            
                        ?>

                            <h4>Tu pedido se entregará en la siguiente direccion:</h4>
                            <p style="text-transform:uppercase;"><?php echo $direccion; ?></p>

                            <div class="container">
                                <span>¿No es la dirección? <a class="btn btn-danger showButton show ml-2">actualizala
                                        aquí</a></span>
                                <button class="btn btn-danger hideButton hidden" style="display: none;"><i
                                        class="far fa-times-circle"></i></button>
                            </div>

                            <div class="hidden" style="display: none;">
                                <form method="post" enctype="multipart/form-data">

                                    <div class="container rounded bg-white mt-3">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="p-3 py-5 pt-0">

                                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                                        <h6 class="text-right">Editar dirección del envío</h6>

                                                    </div>

                                                    <?php

                                                        echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">

                                                        <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">

                                                        <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">

                                                        <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';



                                                        if($_SESSION["modo"] == "directo"){

                                                            echo'

                                                            <div class="row mt-3">

                                                                <div class="col-md-4">

                                                                    <label for="pwd">Calle y número: </label>

                                                                    <input type="text" class="form-control" id="editarCalle" name="editarCalle" placeholder = "Calle y número">

                                                                </div>

                                                                <div class="col-md-4">

                                                                    <label for="pwd">Colonia:</label>

                                                                    <input type="text" class="form-control" id="editarColonia" name="editarColonia" placeholder = "Colonia">

                                                                </div>

                                                                <div class="col-md-4">

                                                                    <label for="pwd">Código postal: </label>

                                                                    <input type="text" class="form-control" id="editarCp" name="editarCp" placeholder = "Código postal">

                                                                </div>
                                                                <div class="col-md-4 pt-2">

                                                                <label for="pwd">Municipio / Ciudad: </label>

                                                                <input type="text" class="form-control" id="editarMunicipio" name="editarMunicipio" placeholder = "Municipio / Ciudad">

                                                            </div>

                                                            </div>

                                                            <div class="mt-5 text-left">

                                                                <button class="btn btn-primary profile-button" type="submit">Actualizar datos</button>

                                                            </div>

                                                            ';

                                                        }

                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <?php

                                $actualizarPerfil = new ControladorUsuarios();

                                $actualizarPerfil -> ctrActualizarDireccion();



                                 ?>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php
                if(isset($_SESSION["validarSesion"])){
                    if($_SESSION["validarSesion"] == "ok"){
                        echo'<div class="column"><a class="btn btn-success btn-lg" id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="'.$_SESSION["id"].'" style="background-color: #00457C !important; border-color:#00457C !important;">Realizar pago con PayPal <i class="fab fa-paypal"></i></a>
                        <a class="btn btn-success btn-lg btnTransferencia" id="btnTransferencia" onclick="pago()"><i class="icon-arrow-left"></i>Transferencia bancaria <i class="fas fa-money-check-alt"></i></a>
                        </div>
                        ';
                    }
                }else{
                    echo '<div class="column"><a class="btn btn-success btn-lg" href="#modalIngreso" data-toggle="modal" style="background-color: #00457C !important; border-color:#00457C !important;">Realizar pago con PayPal <i class="fab fa-paypal"></i></a>
                    <a class="btn btn-success btn-lg" href="#modalIngreso" data-toggle="modal"><i class="icon-arrow-left"></i>Transferencia bancaria <i class="fas fa-money-check-alt"></i></a></div>
                    ';
                }
            ?>



        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="modalCheckout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f9dd00;">
                <h4 class="modal-title" id="exampleModalLabel">Realiza tu pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body contenidoCheckout">
                <?php
                    $respuesta = ControladorCarrito::ctrMostrarTarifas();
                    echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
                    <input type="hidden" id="envioNacional" value="'.$respuesta["envioNacional"].'">
                    <input type="hidden" id="envioInternacional" value="'.$respuesta["envioInternacional"].'">
                    <input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasaMinimaNal"].'">
                    <input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasaMinimaInt"].'">
                    <input type="hidden" id="tasaCiudad" value="'.$respuesta["ciudad"].'">

              ';
                ?>

                <div class="container">
                    <div class="row formEnvio" style="display: none;">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Selecciona tu municipio para calcular el
                                    envío </h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" id="seleccionarCiudad">
                                    <option value="">Seleccionar municipio</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row formaPago">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Seleccionar Forma de pago</h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <center>
                                <input type="radio" name="pago" id="checkPaypal" value="paypal" checked>
                            </center>
                            <img src="<?php echo $url?>vistas/img/plantilla/paypal.jpg" alt="paypal"
                                class="img-thumbnail">
                        </div>

                        <!-- <div class="col-xs-12 col-sm-6">
                            <center>
                                <input type="radio" name="pago" id="checkPayu" value="payu">
                            </center>
                            <img src="<?php echo $url?>vistas/img/plantilla/paypal.jpg" alt="paypal"
                                class="img-thumbnail">
                        </div> -->

                    </div>

                    <div class="listaProductos row" id="cuerpoInfo">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Productos</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped tablaProductos">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-xs-12 ml-auto">
                            <div class="table-responsive">
                                <table class="table table-striped tablaTasas">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>$ <span class="valorSubtotal" valor="0">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Envio</td>
                                            <td>$ <span class="valorTotalEnvio" valor="0">0</span></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td><strong>IVA</strong></td>
                                            <td>$ <span class="valorTotalImpuesto" valor="0">0</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td>$ <span class="valorTotalCompra" valor="0">0</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <input id="cambiarDivisa" type="hidden" value="MXN">
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 text-center mt-3">
                        <button type="button" class="btn btn-primary btnPagar">Realizar pago</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="modalTransferencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f9dd00;">
                <h4 class="modal-title" id="exampleModalLabel">Realiza tu pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body contenidoCheckout">
                <?php
                    // $respuesta = ControladorCarrito::ctrMostrarTarifas();
                    // echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
                    // <input type="hidden" id="envioNacional" value="'.$respuesta["envioNacional"].'">
                    // <input type="hidden" id="envioInternacional" value="'.$respuesta["envioInternacional"].'">
                    // <input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasaMinimaNal"].'">
                    // <input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasaMinimaInt"].'">
                    // <input type="hidden" id="tasaCiudad" value="'.$respuesta["ciudad"].'">';
                ?>
                <div class="container">
                    <div class="row formEnvio1" style="display: none;">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Selecciona tu municipio para calcular el envío.</h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" id="seleccionarCiudad1">
                                    <option value="">Seleccionar municipio</option>
                                    <option value="SALT">El Salto</option>
                                    <option value="GDL">Guadalajara</option>
                                    <option value="ST">Tlaquepaque</option>
                                    <option value="TZ">Tlajomulco de Zuñiga</option>
                                    <option value="TN">Tonalá</option>
                                    <option value="ZP">Zapopan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row formaPago">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Seleccionar Forma de pago</h4>
                                <h5>* Las instrucciones de pago se enviaran al correo electronico que tienes registrado.
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="listaProductos row">
                        <div class="card w-100 border-0">
                            <div class="card-body p-0">
                                <h4 style="text-align: center !important;">Productos</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped tablaProductos">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-xs-12 ml-auto">
                            <div class="table-responsive">
                                <table class="table table-striped tablaTasas">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>$ <span class="valorSubtotal" valor="0">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Envio</td>
                                            <td>$ <span class="valorTotalEnvio" valor="0">0</span></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td><strong>IVA</strong></td>
                                            <td>$ <span class="valorTotalImpuesto" valor="0">0</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td>$ <span class="valorTotalCompra" valor="0">0</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <input id="cambiarDivisa" type="hidden" value="MXN">
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 text-center mt-3">
                        <button type="button" class="btn btn-primary btnTransferencia">Realizar pago</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div> -->