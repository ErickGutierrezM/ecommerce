<!--VALIDAR SESIONES-->

<?php

$url = Ruta::ctrRuta();

$servidor = Ruta::ctrRutaServidor();


if(!isset($_SESSION["validarSesion"])){

    echo'

    <script>

window.location = "'.$url.'"

</script>

    ';

    exit();

}

?>

<div class="container">

    <div class="row">

        <div class="col-xs-12">

            <nav class="bg-bread" aria-label="breadcrumb">

                <ol class="breadcrumb text-capitalize">

                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>">Inicio</a></li>

                    <li class="breadcrumb-item active pagAct" aria-current="page"><?php echo $rutas[0]; ?></li>

                </ol>

            </nav>

        </div>

    </div>

</div>



<div class="container mt-3">



    <!-- Nav tabs -->

    <ul class="nav nav-tabs">

        <li class="nav-item">

            <a class="nav-link active" data-toggle="tab" href="#compras"><i class="fab fa-paypal"></i> Mis
                compras con PayPal </a>

        </li>
        <li class="nav-item">

            <a class="nav-link" data-toggle="tab" href="#comprasTransferencia"><i class="fas fa-money-check"></i> Mis
                compras con transferencia bancaria </a>

        </li>

        <li class="nav-item">

            <a class="nav-link" data-toggle="tab" href="#perfil"><i class="fas fa-user"></i> Editar perfil</a>

        </li>

        <li class="nav-item">

            <a class="nav-link" data-toggle="tab" href="#contacto"><i class="far fa-address-card"></i> Mi dirección e
                información de contacto</a>

        </li>

    </ul>

    <!-- Tab panes -->

    <div class="tab-content">

        <!-- Tab Compras -->

        <div id="compras" class="container tab-pane active"><br>

            <div class="container w-100">

                <?php

                    $item = "id_usuario";

                    $valor = $_SESSION["id"];

                    $compras = ControladorUsuarios::ctrMostrarCompras($item, $valor);
                    

                    if(!$compras){

                        echo'

                        <div class="container my-4">        

                            <div class="border border-light p-3 mb-4">

                            

                                <div class="text-center">

                                    <h2>¡Nada que mostrar!</h2>

                                    <p>Aun no tienes compras realizadas </p>

                                </div>

                            </div>

                        </div>

                        ';

                    }else{

                        foreach($compras as $key => $value1){

                            $ordenar = "fecha";

                            $item = "id";

                            $valor = $value1["id_producto"];


                            $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

                            foreach($productos as $key => $value2){

                            echo'

                                <div class="card w-100 mb-2">

                                 <div class="card-body">

                                 <div class="row">

                                         <div class="col-xs-12 col-sm-4">

                                             <img class="card-img img-thumbnail" src="'.$servidor.$value2["portada"].'">

                                         </div>

                                         <div class="col-xs-12 col-sm-8">

                                            <h2><small>'.$value2["titulo"].'</small></h2>

                                            <p>'.$value2["titular"].'</p>

                                            <h6><span class="text-muted">Proceso de entrega: </span>'.$value2["entrega"].' días hábiles</h6>';



                                            if($value1["envio"] == 0){

                                                echo'

                                                <div class="progress">

                                                    <div class="progress-bar bg-success" role="progressbar" style="width:25%">

                                                        <ul>

                                                            <li><i class="fas fa-clipboard-check"></i> Pedido recibido</li>

                                                        </ul> 

                                                    </div>



                                                </div>

                                                

                                                ';

                                            }
                                            if($value1["envio"] == 1){

                                                echo'

                                                <div class="progress">

                                                    <div class="progress-bar bg-success" role="progressbar" style="width:75%">

                                                        <ul>

                                                            <li><i class="fas fa-truck"></i> Enviando el pedido</li>

                                                        </ul> 

                                                    </div>

                                                </div>

                                                ';

                                            }

                                            if($value1["envio"] == 2){

                                                echo'

                                                <div class="progress">

                                                    <div class="progress-bar bg-success" role="progressbar" style="width:100%">

                                                        <ul>

                                                            <li><i class="fas fa-warehouse"></i> Pedido entregado</li>

                                                        </ul> 

                                                    </div>

                                                </div>

                                                ';

                                            }

                                            echo'

                                            <h6 class="text-right mt-2"><span class="text-muted">Fecha de compra: </span>'.substr($value1["fecha"],0,-8).'</h6>

                                         </div>

                                     </div>

                                </div>

                              </div>

                            ';



                            } 

                        }

                    }

                ?>

            </div>

        </div>

        <!-- Tab deseos -->

        <div id="comprasTransferencia" class="container tab-pane fade"><br>

            <div class="container">
                <?php

                $item = "id_usuario";

                $valor = $_SESSION["id"];

                $comprasTransferencia = ControladorUsuarios::ctrMostrarComprasTransferencia($item, $valor);

           //var_dump($comprasTransferencia);

               if(!$comprasTransferencia){

                    echo'

                    <div class="container my-4">        

                        <div class="border border-light p-3 mb-4">

                        

                            <div class="text-center">

                                <h2>¡Nada que mostrar!</h2>

                                <p>Aun no tienes compras realizadas </p>

                            </div>

                        </div>

                    </div>

                    ';

                }else{

                    foreach($comprasTransferencia as $key => $value1){

                        $ordenar = "fecha";

                        $item = "id";

                        $valor = $value1["id"];


                        $productosTransferencia = ControladorProductos::ctrListarVentas($ordenar, $item, $valor);

                       //var_dump($productosTransferencia[0]["productos"]);

                       $ventasTransferencia = json_decode($productosTransferencia[0]["productos"],2);
                       //var_dump($ventasTransferencia);
                       foreach ($ventasTransferencia as $keyVentas => $valueVentas) {
                         //$productosV.=("<ul> <li>".$valueVentas["titulo"]."</li></ul>");

                         echo'

                         <div class="card w-100 mb-2">

                          <div class="card-body w-100">

                          <div class="row">

                                  <div class="col-xs-12 col-sm-12">

                                     <h2><small>'.$valueVentas["titulo"].'</small></h2>



                                     <h6><span class="text-muted">Proceso de entrega: </span>3 días hábiles</h6>';



                                     if($value1["envio"] == 0){

                                         echo'

                                         <div class="progress">

                                             <div class="progress-bar bg-success" role="progressbar" style="width:25%">

                                                 <ul>

                                                     <li><i class="fas fa-clipboard-check"></i> Pedido recibido</li>

                                                 </ul> 

                                             </div>



                                         </div>

                                         

                                         ';

                                     }
                                     if($value1["envio"] == 1){

                                         echo'

                                         <div class="progress">

                                             <div class="progress-bar bg-success" role="progressbar" style="width:75%">

                                                 <ul>

                                                     <li><i class="fas fa-truck"></i> Enviando el pedido</li>

                                                 </ul> 

                                             </div>

                                         </div>

                                         ';

                                     }

                                     if($value1["envio"] == 2){

                                         echo'

                                         <div class="progress">

                                             <div class="progress-bar bg-success" role="progressbar" style="width:100%">

                                                 <ul>

                                                     <li><i class="fas fa-warehouse"></i> Pedido entregado</li>

                                                 </ul> 

                                             </div>

                                         </div>

                                         ';

                                     }

                                     echo'

                                     <h6 class="text-right mt-2"><span class="text-muted">Fecha de compra: </span>'.substr($value1["fecha"],0,-8).'</h6>

                                  </div>

                              </div>

                         </div>

                       </div>

                     ';




                        }

                        // var_dump($productosV);
                }

            }

            ?>
            </div>

        </div>

        <!-- Tab perfil -->

        <div id="perfil" class="container tab-pane fade"><br>

            <form method="post" enctype="multipart/form-data">

                <div class="container rounded bg-white mt-3">

                    <div class="row">

                        <div class="col-md-4 border-right">

                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                <figure id="imgPerfil">

                                    <?php

                             if($_SESSION["modo"] == "directo"){

                                    if($_SESSION["foto"] != ""){

                                        echo'

                                        <img src="'.$url.$_SESSION["foto"].'"  class="rounded-circle mt-5" width="120">

                                        ';

                                    }else{

                                        echo'

                                        <img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png"  class="rounded-circle mt-5" width="120">

                                        '; 

                                    }

                                }else{

                                    echo'

                                    <img src="'.$_SESSION["foto"].'" class="rounded-circle mt-5" width="120">

                                    ';

                                }

                                echo'';

                                ?>

                                </figure>

                                <?php

                                    if($_SESSION["modo"] == "directo"){

                                        echo'

                                            <div class="text-center mt-2">

                                                <buttton type="button" class="btn btn btn-primary btn-sm" id="btnCambiarFoto">Editar foto de perfil</buttton>

                                            </div>';

                            

                                    }

                                
                                ?>

                                <div class="container">

                                    <div id="subirImagen">

                                        <input type="file" class="form-control" name="datosImagen" id="datosImagen">

                                        <img class="previsualizar" style="width: 60%; padding: 10px;">

                                    </div>

                                </div>



                            </div>



                        </div>

                        <div class="col-md-8">

                            <div class="p-3 py-5">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <h6 class="text-right">Editar perfil</h6>

                                </div>

                                <?php

							echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">

                            <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">

                            <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">

                            <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';



                                if($_SESSION["modo"] != "directo"){



                                    echo'

                                    <div class="row mt-2">

                                        <div class="col-md-12">

                                            <label for="editarNombre">Nombre:</label>

                                            <input type="text" class="form-control"  value="'.$_SESSION["nombre"].'" readonly>

                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-md-12">

                                            <label for="editarEmail">Actualizar correo electrónico: </label>

                                            <input type="text" class="form-control"  value="'.$_SESSION["email"].'" readonly>

                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-md-12">

                                            <label for="editarEmail">Red social en la que ingreso: </label>

                                            <input type="text" class="form-control"  value="'.$_SESSION["modo"].'" readonly>

                                        </div>

                                    </div>

                                    ';

                                }else{

                                    echo'

                                    <div class="row mt-2">

                                        <div class="col-md-12">

                                            <label for="editarNombre">Actualizar nombre:</label>

                                            <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">

                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-md-12">

                                            <label for="editarEmail">Actualizar correo electrónico: </label>

                                            <input type="text" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">

                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                    <div class="col-md-12">

                                        <label for="editarTelefono">Actualizar teléfono: </label>

                                        <input type="text" class="form-control" id="editarTelefono" name="editarTelefono" value="'.$_SESSION["telefono"].'">

                                    </div>

                                </div>

                                    <div class="row mt-3">

                                        <div class="col-md-12">

                                            <label for="pwd">Actualizar contraseña: </label>

                                            <input type="text" class="form-control" id="editarPassword" name="editarPassword" placeholder = "Escribe la nueva contraseña">

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

                    $actualizarPerfil -> ctrActualizarPerfil();



                ?>

            </form>

            <div class="mt-2 mb-2 text-right">

                <button class="btn btn-danger btn-md" id="eliminarUsuario">Eliminar cuenta</button>

            </div>

            <?php



                $borrarUsuario = new ControladorUsuarios();

                $borrarUsuario->ctrEliminarUsuario();



            ?>



        </div>
        <!-- Tab deseos -->

        <div id="contacto" class="container tab-pane fade">

            <div class="row ">
                <form method="post" enctype="multipart/form-data">

                    <div class="container rounded mt-3">

                        <div class="row">
                            <div class="col-md-8">

                                <div class="p-3 py-5 pt-0">

                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                        <h2 class="text-right">Información de envio </h2>
                                        <small style="color:red;">* Al editar la informacion debera llenar todos los campos</small>
                                    </div>

                                    <?php

                                echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">

                                <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">

                                <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">

                                <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';



                                if($_SESSION["modo"] == "directo"){

                                    echo'

                                    <div class="row mt-3">

                                        <div class="form-group p-3">

                                            <label for="pwd">Calle y número: </label>

                                            <input type="text" class="form-control" id="editarCalle" name="editarCalle" placeholder = "Calle y número">

                                        </div>

                                        <div class="form-group p-3">

                                            <label for="pwd">Colonia:</label>

                                            <input type="text" class="form-control" id="editarColonia" name="editarColonia" placeholder = "Colonia">

                                        </div>

                                        <div class="form-group p-3">

                                            <label for="pwd">Código postal: </label>

                                            <input type="text" class="form-control" id="editarCp" name="editarCp" placeholder = "Código postal">

                                        </div>
                                        <div class="form-group p-3">

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

                            <div class="col-sm-4">
                                <?php


                                $username = "andamio8_admin";
                                $password = "AES%2021#F";
                                $database = "andamio8_ecommerce";

                                $mysqli = new mysqli("localhost:3306", $username, $password, $database);


                                $sql = mysqli_query( $mysqli, "SELECT * FROM usuarios WHERE id = '".$_SESSION["id"]."'");
                                $result_f = mysqli_fetch_array($sql);

                                // var_dump($result_f);
                                ?>

                                <div class="card w-100 m-4">
                                    <div class="container p-2">

                                        <h3>Dirección de envio</h3>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Calle</span>:
                                                <?php echo $result_f[7]; ?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Colonia</span>:
                                                <?php echo $result_f[8]; ?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Código Postal</span>:
                                                <?php echo $result_f[9]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Municipio</span>:
                                                <?php echo $result_f[10]; ?></p>
                                        </div>
                                        <h3>Información de contacto</h3>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Correo electrónico </span>:
                                                <?php echo $result_f[3]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Teléfono</span>:
                                                <?php echo $result_f[4]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <?php

                        $actualizarPerfil = new ControladorUsuarios();

                        $actualizarPerfil -> ctrActualizarDireccionP();

                    ?>

                </form>


            </div>
            <hr class="dotted">
            <div class="row  mt-2 mb-2">
                <form method="post" enctype="multipart/form-data">

                    <div class="container rounded mt-3">

                        <div class="row">
                            <div class="col-md-8">

                                <div class="p-3 py-5 pt-0">

                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                        <h2 class="text-right">Información de facturación</h2>
                                        <small style="color:red;">* Al editar la informacion debera llenar todos los campos</small>
                                    </div>

                                    <?php

                                echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">

                                <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">

                                <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">

                                <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';



                                if($_SESSION["modo"] == "directo"){

                                    echo'

                                    <div class="row mt-3">

                                        <div class="form-group p-3">

                                            <label for="pwd">Nombre o Razón Social: </label>

                                            <input type="text" class="form-control" id="editarRazon" name="editarRazon" placeholder = "Nombre o Razón Social">

                                        </div>

                                        <div class="form-group p-3">

                                            <label for="pwd">Calle y Número:</label>

                                            <input type="text" class="form-control" id="editarCalleFacturacion" name="editarCalleFacturacion" placeholder = "Calle y Número">

                                        </div>

                                        <div class="form-group p-3">

                                            <label for="pwd">Código postal: </label>

                                            <input type="text" class="form-control" id="editarCpFacturacion" name="editarCpFacturacion" placeholder = "Código postal">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">Municipio / Ciudad: </label>

                                            <input type="text" class="form-control" id="editarMunicipioFacturacion" name="editarMunicipioFacturacion" placeholder = "Municipio / Ciudad">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">Estado: </label>

                                            <input type="text" class="form-control" id="editarEstadoFacturacion" name="editarEstadoFacturacion" placeholder = "Estado">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">RFC: </label>

                                            <input type="text" class="form-control" id="editarRFC" name="editarRFC" placeholder = "RFC">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">Uso del CFDI: </label>

                                            <input type="text" class="form-control" id="editarCFDI" name="editarCFDI" placeholder = "Uso del CFDI ">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">Teléfono: </label>

                                            <input type="text" class="form-control" id="editarTelefonoFacturacion" name="editarTelefonoFacturacion" placeholder = "Teléfono ">

                                        </div>
                                        <div class="form-group p-3">

                                            <label for="pwd">Correo Electrónico: </label>

                                            <input type="text" class="form-control" id="editarMailFacturacion" name="editarMailFacturacion" placeholder = "Correo Electrónico ">

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

                            <div class="col-sm-4">
                                <?php


                                $username = "andamio8_admin";
                                $password = "AES%2021#F";
                                $database = "andamio8_ecommerce";

                                $mysqli = new mysqli("localhost:3306", $username, $password, $database);


                                $sql = mysqli_query( $mysqli, "SELECT * FROM usuarios WHERE id = '".$_SESSION["id"]."'");
                                $result_fac = mysqli_fetch_array($sql);

                               // var_dump($result_fac);
                                ?>

                                <div class="card w-100 m-2">
                                    <div class="container p-2">

                                        <h3>Datos de facturación: </h3>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Nombre o Razón Social</span>:
                                                <?php echo $result_fac[11]; ?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Calle y Número</span>:
                                                <?php echo $result_fac[12]; ?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Código Postal</span>:
                                                <?php echo $result_fac[13]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Municipio / Ciudad</span>:
                                                <?php echo $result_fac[14]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Estado</span>:
                                                <?php echo $result_fac[15]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">RFC</span>:
                                                <?php echo $result_fac[16]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Uso del CFDI</span>:
                                                <?php echo $result_fac[17]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Teléfono</span>:
                                                <?php echo $result_fac[18]; ?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span style="font-weight: bold; color:black;">Correo Electrónico</span>:
                                                <?php echo $result_fac[19]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <?php

                        $actualizarPerfil = new ControladorUsuarios();

                        $actualizarPerfil -> ctrActualizarFacturacion();

                    ?>

                </form>
            </div>

        </div>

    </div>

</div>