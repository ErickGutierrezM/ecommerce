<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();



?>

<div class="container-fluid mb-4 mt-3">

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



</div>

<?php

    $item = "ruta";

    $valor = $rutas[0];

    $infoProducto = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

    $multimedia = json_decode($infoProducto["multimedia"],true);



?>



<div class="container-fluid">

    <div class="row">

        <div class="col-xs-12 col-sm-4" style="background-color: #F9DD00;">

            <div class="text-center mx-auto pt-2 pb-2">

                <?php

               echo' <h1 style="text-transform: capitalize;">'.$infoProducto["titulo"].'</h1>';

                ?>

            </div>

        </div>

    </div>

</div>



<div class="container-fluid infoProducto mt-5">

    <div class="container">

        <div class="row">

            <!--VISOR DE IMAGENES-->

            <div class="col-md-5 col-xs-12 visorImg">

                <figure class="visor">

                    <?php

                        if($multimedia != null){



                            for($i = 0; $i < count($multimedia); $i ++)

                            {

							    echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'">';

                            }	

                        }

						



                        ?>

                </figure>



                <div class="flexslider carousel">

                    <ul class="slides">

                        <?php

                         if($multimedia != null){

                                for($i = 0; $i < count($multimedia); $i ++)

                                {

                                    echo'

                                    <li>

                                    <img class="img-thumbnail"

                                    src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoProducto["titulo"].'" value="'.($i+1).'">

                                    </li>

                                    ';

                                }

                            }



                        ?>



                    </ul>

                </div>

            </div>

            <!--PRODUCTO-->

            <div class="col-md-7 col-sm-6 col-xs-12">

                <!--volver a la tienda-->

                <div class="col-xs-6">

                    <a href="javascript:history.back()" class="text-muted">

                        <i class="fas fa-reply"></i> Continuar comprando

                    </a>

                </div>

                <div class="col-xs-6">



                </div>

                <div class="clearfix"></div>

                <!--INFO DEL PRODUCTO-->



                <div class="card detalles">

                    <div class="card-body">

                        <?php

                        if($infoProducto["precio"] == 0){

                            echo'

                                <h2 class="card-title">Gratis</h2>

                            ';

                        }else{

                            if($infoProducto["oferta"] == 0){

                                echo'

                                    <h2 class="card-title">$ '.number_format($infoProducto["precio"], 2, '.', ',').'</h2>

                                '; 

                            }else{

                                echo'

                                <h2 class="card-title"><del><small>$ '.number_format($infoProducto["precio"], 2, '.', ',').'</del></small> $ '.number_format($infoProducto["precioOferta"], 2, '.', ',').'</h2>

                            '; 

                                

                            }



                        }

                        echo'<p class="card-text">'.$infoProducto["descripcion"].'</p>';

                        ?>

                        <!--CARACTERISTICAS DEL PRODUCTO--->

                        <hr>

                        <div class="container">

                            <div class="row">

                                <div class="col-xs-12">

                                    <h3>Características</h3>

                                    <ul class="listaCaracteristicas">

                                        <?php

                                            if($infoProducto["detalles"] != null){

                                                $detalles = json_decode($infoProducto["detalles"], true);

                                                // var_dump($detalles);



                                                if($detalles["Ancho"]!=null){

                                                    echo'

                                                    <li><strong>Ancho: </strong> '.$detalles["Ancho"].'</li>

                                                    ';

                                                }

                                                if($detalles["Alto"]!=null){

                                                    echo'

                                                    <li><strong>Alto:  </strong> '.$detalles["Alto"].'</li>

                                                    ';

                                                }

                                                if($detalles["Largo"]!=null){

                                                    echo'

                                                    <li><strong>Largo:  </strong> '.$detalles["Largo"].'</li>

                                                    ';

                                                }

                                                if($detalles["Peso"]!=null){

                                                    echo'

                                                    <li><strong>Peso:  </strong> '.$detalles["Peso"].'</li>

                                                    ';

                                                }

                                                if($detalles["Calibre"]!=null){

                                                    echo'

                                                    <li><strong>Calibre:  </strong> '.$detalles["Calibre"].'</li>

                                                    ';

                                                }

                                            }

                                    

                                        ?>

                                    </ul>

                                </div>



                            </div>

                        </div>

                        <hr>

                        <div class="container">

                            <div class="row">

                                <div class="col-xs-12">

                                    <?php

                                    if($infoProducto["inventario"] == 0){

                                        echo'<h4><span class="text-danger">Producto sin stock, contáctanos para conocer cuando estará disponible.</span></h4>';

                                    }else{

                                        echo'<h4>Tenemos '.$infoProducto["inventario"].' en existencia.</h4><small class="text-muted">¡En caso de necesitar más. contáctanos!</small> ';

                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="container">

                            <div class="row">

                                <div class="col-xs-12">

                                    <?php

                                        if($infoProducto["entrega"] == 0){

                                            echo '

                                            <h4 class="col-md-12 col-sm-0 col-xs-0">

                                            <span class="label label-default" style="font-weight: 100">

                                            <i class="far fa-clock"></i>Entrega el mismo día  

                                            <i class="fas fa-eye" style="margin:0px 5px; visibility:hidden ;">visto por</i>  <span class="vistas" style="visibility:hidden ;"> '.$infoProducto["vistas"].'  personas.</span>

                                            </span>

                                            </h4>

                                            ';

                                        }else{

                                            echo '

                                            <h4 class="col-md-12 col-sm-0 col-xs-0">

                                            <span class="label label-default" style="font-weight: 100">

                                            <i class="far fa-clock" style="margin:0px 5px;"></i>'.$infoProducto["entrega"].' días hábiles para la entrega  

                                            <i class="fas fa-eye" style="margin:0px 5px; visibility:hidden ;">  visto por</i> <span class="vistas" style="visibility:hidden ;"> '.$infoProducto["vistas"].'  personas.</span>

                                            </span>

                                            </h4>

                                            ';

                                        }

                                    

                                    ?>

                                </div>

                            </div>

                        </div>

                        <hr>



                        <div class="container">

                            <div class="row">

                                <?php

                                    if($infoProducto["precio"]==0){

                                        echo'

                                        <div class="col-md-6 col-xs-12 mx-auto">

                                            <button class="btn btn-block btn-lg ripple btnCart">Button</button>

                                        </div>

                                        ';

                                    }else{



                                        if($infoProducto["oferta"] != 0){

                                            //precio con oferta

                                            echo'

                                            <div class="col-md-6 col-xs-12 mx-auto">

                                                <button class="btn btn-block btn-sm ripple btnCart agregarCarrito" style="font-style: uppercase;" idProducto="'.$infoProducto["id"].'" imagen="'.$servidor.$infoProducto["portada"].'" titulo="'.$infoProducto["titulo"].'" precio="'.$infoProducto["precioOferta"].'">

                                                Añadir al carrito

                                                </button>

                                            </div>

                                            ';

                                        }else{



                                            echo'

                                            <div class="col-md-6 col-xs-12 mx-auto">

                                                <button class="btn btn-block btn-lg ripple btnCart agregarCarrito" style="font-style: uppercase;" idProducto="'.$infoProducto["id"].'" imagen="'.$servidor.$infoProducto["portada"].'" titulo="'.$infoProducto["titulo"].'" precio="'.$infoProducto["precio"].'" tipo="'.$infoProducto["tipo"].'" inventario="'.$infoProducto["inventario"].'" peso="'.$infoProducto["peso"].'" ">

                                                Añadir al carrito

                                                </button>

                                            </div>

                                            ';

                                        }



                                    }

                                        

                                ?>





                            </div>

                        </div>

                        <!-- <a href="#" class="card-link">Card link</a>

                        <a href="#" class="card-link">Another link</a> -->

                    </div>

                </div>



                <!--LUPA-->

                <figure class="lupa">

                    <img src="" alt="">

                </figure>



            </div>



        </div>

    </div>

</div>
<!--<i class="fas fa-eye" style="margin:0px 5px;"></i> visto por <span class="vistas"> '.$infoProducto["vistas"].'</span> personas.-->


<div class='container p-4'>

    <div class="row">





        <?php

            $item = "id";

            $valor = $infoProducto["id_categoria"];



            $relacionados = ControladorProductos::CtrMostrarCategorias($item, $valor);

            // var_dump($relacionados["ruta"]);



        ?>

        <div class="col-xs-12 titulo text-center">

            <div class="col-xs-12">

                <h2>Productos relacionados</h2>

            </div>

        </div>

    </div>

    <hr>

    <div class="clearfix"></div>



    <?php 

        $orden = "";

        $item = "id_categoria";

        $valor = $infoProducto["id_categoria"];

        $base = 0;

        $tope = 4;

        $modo = "Rand()";



        $relacionadosP = ControladorProductos::ctrMostrarProductos($orden,$item, $valor,$base, $tope, $modo);



        if(!$relacionadosP){

            echo '

            <div class="container">

            <div class="col-xs-12 text-center">

            <h1><small>¡Lo sentimos!</small></h1>

                <h2>No tenemos productos relacionados en esta categoría</h2>

            </div>

            </div>

            ';

        }else{

            echo'<div class="row">';

            foreach($relacionadosP as $key => $value){

                if($value["estado"] != 0){



                echo'

                <div class="card mx-auto col-xs-12 col-sm-6 col-md-3 border-0 productCard"> 

                <a href="'.$url.$value["ruta"].'"> <img class="mx-auto img-fluid" src="'.$servidor.$value["portada"].'" /></a>

                    <div class="card-body text-center mx-auto">

                        <div class="cvp">

                           <a href="'.$url.$value["ruta"].'"> <h5 class="card-title font-weight-bold">'.$value["titulo"].' ';

                           if($value["nuevo"] !=0){

                               echo'<span class="badge badge-secondary">Nuevo</span></h5></a>';

                           }

                       if($value["oferta"] != 0){

                           echo'

                           <p class="card-text">

                           <del><small>$ '.number_format($value["precio"], 2, '.', ',').'</del></small> $ '.number_format($value["precioOferta"], 2, '.', ',').'</p>

                           ';

                       }else{

                        echo'

                        <p class="card-text">$ '.number_format($value["precio"], 2, '.', ',').'</p>

                        ';

                       }

                             

                            

                            echo' <a href="'.$url.$value["ruta"].'" class="btn details px-auto">Ver detalles</a>

    

                        </div>

                    </div>

                </div>

                

                ';

                }

            }

            echo'</div>';



        }



    

    ?>



</div>

