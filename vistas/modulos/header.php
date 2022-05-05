<?php

        

        $urlServer = Ruta::ctrRutaServidor();

        $url = Ruta::ctrRuta();





?>

<!-- Header -->

<header class="header">

    <!-- Top Bar -->

    <div class="top_bar">

        <div class="container">

            <div class="row">

                <div class="col d-flex flex-row">

                    <div class="top_bar_contact_item">

                        <div class="top_bar_icon"><img src="http://andamiosexpressstore.mx/vistas/img/icons/phone-09.png" width="35px" height="35px"/>
                        </div><a href="tel:3313239376">33 13 23 93 76</a> 


                    </div>

                    <!-- <div class="top_bar_contact_item">

                        <div class="top_bar_icon"><img src="http://andamiosexpressstore.mx/vistas/img/icons/whatsapp-09.png" width="35px" height="35px"/>

                        </div><a href="https://wa.me/523313239376">33 13 23 93 76</a>

                    </div> -->

                    <div class="top_bar_content ml-auto">

                    <div class="top_bar_user" style="text-align: end;">

                            <?php

                                if(isset($_SESSION["validarSesion"])){

                                    if($_SESSION["validarSesion"] == "ok"){

                                        if($_SESSION["modo"] == "directo"){

                                            if($_SESSION["foto"] != ""){

                                                echo'

                                                <img class="rounded-circle" src="'.$url.$_SESSION["foto"].'" width="6%">



                                                ';

                                            }else{

                                                echo'

                                                <img class="rounded-circle" src="'.$urlServer.'vistas/img/usuarios/default/anonymous.png" >



                                                ';  

                                            }

                                            echo'

                                            <div><a href="'.$url.'perfil"> | Ver perfil</a></div>

                                            <div><a href="'.$url.'salir"> | Salir</a></div>

                                            ';



                                        }

                                    }

                                }else{

                                    echo'

                                    <div><a href="#modalRegistro" data-toggle="modal">Registrarse</a> </div>

                                    <div><a href="#modalIngreso" data-toggle="modal">| Iniciar sesion</a></div>

                                    ';

                                }



                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div> <!-- Header Main -->

    <div class="header_main">

        <div class="container">

            <div class="row">

                <!-- Logo -->

                <div class="col-lg-6 col-sm-6 col-3 order-1">

                    <div class="logo_container">

                        <div class="logo d-sm-none d-md-none d-md-block">

                            <a class="navbar-brand js-scroll-trigger" href="<?php echo $url;?>">

                                <img src="http://panel.andamiosexpressstore.mx/vistas/img/plantilla/andamiosExpress.png"

                                    class="img-fluid" alt="">

                            </a>

                        </div>

                        <div class="logo-mobil d-lg-none d-md-block d-sm-block pt-1">

                            <a class="navbar-brand js-scroll-trigger" href="<?php echo $url;?>">

                                <img src="http://panel.andamiosexpressstore.mx/vistas/img/plantilla/logo_mobil.png"

                                    class="img-fluid" alt="">

                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6 col-9 order-lg-3 order-2 text-lg-left text-right ml-auto">

                    <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">

                        <div class="wishlist d-flex flex-row align-items-center justify-content-end">

                            <div class="main_nav_menu" id="categorias">

                                <ul class="standard_dropdown main_nav_dropdown">



                                    <li class="hassubs"> <a href="#">Categorias<i class="fas fa-chevron-down"></i></a>

                                        <ul>

                                            <?php

                                                $item = null;

                                                $valor = null;

                                $categorias = ControladorProductos::CtrMostrarCategorias($item, $valor);



                                foreach($categorias as $key => $value){

                                    if($value["estado"] != 0){

                                        echo'  <li><a href="'.$url.$value["ruta"].'">'.$value["categoria"].'</a></li>';

                                    }

                                }

                            ?>

                                        </ul>

                                    </li>

                                </ul>

                            </div>

                        </div> <!-- Cart -->

                        <a href="<?php $url;?>carrito-de-compras">

                            <div class="cart">

                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">

                                    

                                    <div class="cart_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918704/cart.png" alt="">

                                        <div class="cart_count cantidadCesta" style="color:#000;"><span></span></div>

                                    </div>

                                    <div class="cart_content">

                                        <div class="cart_text">Carrito</div>

                                        <div class="cart_price">$ <span class="sumaCesta"></span> </div>

                                    </div>

                                </div>

                            </div>

                        </a>

                        <button id="burger-icon" class="navbar-toggler hamburger" type="button" data-toggle="collapse"

                            data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"

                            aria-label="Toggle navigation">

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                        </button>



                        <div class="collapse navbar-collapse ml-auto" id="navbarContent">

                            <ul class="navbar-nav text-uppercase text-center">

                                <li class="nav-item">

                                    <a class="nav-link" href="quienes-somos">¿Quienes somos?</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="certificaciones">Certificaciones</a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </div> <!-- Main Navigation -->



</header>



<!-- Modal -->

<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #F9DD00;">

                <h3 class="modal-title col-11 text-center" id="exampleModalLabel">Registrarse</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <!-- REGISTRO FACEBOOK -->

                <div class="row">

                 <!--   <div class="col-sm-6 col-xs-12 facebook mb-2" id="btnFacebookRegistro">

                        <button type="button" class="btn btn-icon btn-block text-left" style="font-size: 13px;">

                            <span><img src="https://i.imgur.com/URmkevm.png" class="img-fluid " width="25"></span>

                            Registro con Facebook

                        </button>

                    </div>

                    <div class="col-sm-6 col-xs-12 google mb-2" id="btnGoogleRegistro">

                        <button type="button" class="btn btn-icon btn-block text-left" style="font-size: 13px;">

                            <span><img src="https://img.icons8.com/color/48/000000/google-logo.png" class="img-fluid "

                                    width="25"></span> Registro con Google

                        </button>

                    </div>-->

                    <div class="col-xs-12 col-sm-12 mt-3">

                        <form method="POST" onsubmit="return registroUsuario()">

                            <div class="form-group">

                                <input type="text" class="form-control" id="regUsuario"

                                    name="regUsuario" placeholder="Nombre completo" required>

                            </div>

                            <div class="form-group">

                                <input type="email" class="form-control" id="regEmail" name="regEmail"

                                    placeholder="Correo Electrónico" required>

                            </div>

                            <div class="form-group">

                                <input type="text" class="form-control" id="regTel" name="regTel"

                                    placeholder="Teléfono" required>

                            </div>

                            <div class="form-group">

                                <input type="password" class="form-control" id="regPassword" name="regPassword"

                                    placeholder="Contraseña">

                            </div>

                            <div class="form-check">

                                <input type="checkbox" class="form-check-input" id="regPoliticas">

                                <label class="form-check-label" for="exampleCheck1">Al registrarse, usted acepta

                                    nuestras condiciones de uso y políticas de privacidad.



                                <!--POLITICAS-->

                                <a href="https://www.iubenda.com/privacy-policy/78142138"

                                    class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe "

                                    title="Política de Privacidad ">Política de Privacidad</a>

                                <script type="text/javascript">

                                (function(w, d) {

                                    var loader = function() {

                                        var s = d.createElement("script"),

                                            tag = d.getElementsByTagName("script")[0];

                                        s.src = "https://cdn.iubenda.com/iubenda.js";

                                        tag.parentNode.insertBefore(s, tag);

                                    };

                                    if (w.addEventListener) {

                                        w.addEventListener("load", loader, false);

                                    } else if (w.attachEvent) {

                                        w.attachEvent("onload", loader);

                                    } else {

                                        w.onload = loader;

                                    }

                                })(window, document);

                                </script>

                                </label>

                            </div>

                            <?php

                               $registro = new ControladorUsuarios();

                               $registro -> ctrRegistroUsuario();

                            

                            ?>

                            <div class="col text-center">

                            <input type="submit" class="btn btn-primary mt-2 btn-block" value="Enviar"></input>

                            </div>



                        </form>

                    </div>

                </div>



            </div>

            <div class="modal-footer">

                    ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

            </div>

        </div>

    </div>

</div>



<!-- Modal ingresar -->

<div class="modal fade" id="modalIngreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #F9DD00;">

                <h3 class="modal-title col-11 text-center" id="exampleModalLabel">Ingresar</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <!-- REGISTRO FACEBOOK -->

                <div class="row">

                   <!-- <div class="col-sm-6 col-xs-12 facebook mb-2" id="btnFacebookRegistro">

                        <button type="button" class="btn btn-icon btn-block text-left" style="font-size: 13px;">

                            <span><img src="https://i.imgur.com/URmkevm.png" class="img-fluid " width="25"></span>

                            Ingreso con Facebook

                        </button>

                    </div>

                    <div class="col-sm-6 col-xs-12 google mb-2" id="btnGoogleRegistro">

                        <button type="button" class="btn btn-icon btn-block text-left" style="font-size: 13px;">

                            <span><img src="https://img.icons8.com/color/48/000000/google-logo.png" class="img-fluid "

                                    width="25"></span> Ingreso con Google

                        </button>

                    </div>-->

                    <div class="col-xs-12 col-sm-12 mt-3">

                        <form method="POST">

                            <div class="form-group">

                                <input type="email" class="form-control" id="ingEmail" name="ingEmail"

                                    placeholder="Correo Electrónico" required>

                            </div>

                            <div class="form-group">

                                <input type="password" class="form-control" id="ingPassword" name="ingPassword"

                                    placeholder="Contraseña">

                            </div>

                            <?php

                               $ingreso = new ControladorUsuarios();

                               $ingreso -> ctrIngresoUsuario();

                            

                            ?>

                            <div class="col text-center">

                            <input type="submit" class="btn btn-primary mt-2 btn-block btnIngreso" value="Enviar"></input>

                            </div>



                            <div class="text-center p-3">

                                <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a>

                            </div>



                        </form>

                    </div>

                </div>



            </div>

            <div class="modal-footer">

                    ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarme</a></strong>

            </div>

        </div>

    </div>

</div>



<!-- Modal RECUPERAR CONTRASEÑA -->

<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" 

    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #F9DD00;">

                <h3 class="modal-title col-11 text-center" id="exampleModalLabel">Reestablecer contraseña</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <!-- REGISTRO FACEBOOK -->

                <div class="row">

                    <div class="col-xs-12 col-sm-12 mt-3">

                        <form method="POST">

                            <div class="form-group">

                            <label for="passEmail" class="text-muted">Escribe el correo electrónico registrado para ingresar una nueva contraseña: </label>



                                <input type="email" class="form-control" id="passEmail" name="passEmail"

                                    placeholder="Correo Electrónico" required>

                            </div>

                            <?php

                               $password = new ControladorUsuarios();

                               $password -> ctrOlvidoPassword();

                            



                            

                            ?>



                            <div class="col text-center">

                            <input type="submit" class="btn btn-primary mt-2 btn-block" value="Enviar"></input>

                            </div>



                        </form>

                    </div>

                </div>



            </div>

            <div class="modal-footer">

                    ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarme</a></strong>

            </div>

        </div>

    </div>

</div>