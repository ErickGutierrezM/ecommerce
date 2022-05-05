<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();



?>

<?php



$banner = ControladorProductos::ctrMostrarBanner($ruta);



if($banner != null){

    echo'

    <div class="container-fluid mt-1">

    <div class="row">



        <div class="col-xs-12 col-sm-6 col-md-3 text-center pt-4" style="background-color: #000000;">

        

            <img src="'.$servidor.$banner["img1"].'" class="img-responsive" width="100%">

            

        </div>



        <div class="col-xs-12 col-sm-6 col-md-6 text-center pt-4" style="background-color: #f9dd00;">

            

            <img src="'.$servidor.$banner["img2"].'" class="img-responsive" width="100%">

            

        </div>



        <div class="col-xs-12 col-sm-12 col-md-3 text-center p-5" style="background-color: #000000;">

            <div class="box">

            <img src="'.$servidor.$banner["img3"].'" class="img-responsive" width="100%">

            </div>

        </div>



        </div>

        </div>

    

    ';



}else{

    echo'

    <div class="container-fluid mt-4">

<div class="row">

    <div class="col-xs-12 col-sm-6 col-md-3 text-center p-5" style="background-color: #000000;">

    <div class="box">

    </div>

</div>



<div class="col-xs-12 col-sm-6 col-md-6 text-center p-5" style="background-color: #f9dd00;">

    <div class="box">

    </div>

</div>



<div class="col-xs-12 col-sm-12 col-md-3 text-center p-5" style="background-color: #000000;">

    <div class="box">



    </div>

</div>

</div>

</div>

    

    ';

}



?>


<div class="container mt-2">

    <div class="text-center mx-auto">

        <h1 style="text-transform: capitalize;"><?php echo $rutas[0]; ?></h1>

    </div>

</div>


<div class="container-fluid barraProductos mt-4 mb-4">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">

                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"

                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        Ordenar Productos

                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <?php

                        echo'<a class="dropdown-item" href="'.$url.$rutas[0].'/1/recientes">Más reciente</a>

                        <a class="dropdown-item" href="'.$url.$rutas[0].'/1/antiguos">Más antiguo</a>';

                        ?>

                    </div>

                </div>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 organizarProductos ml-auto">

                <div class="btn-group ">

                    <button type="button" class="btn btn-default btnGrid" id="btnGrid0">

                        <i class="fas fa-th"></i>

                        <span class="col-xs-0">Grid</span>

                    </button>

                    <button type="button" class="btn btn-default btnList" id="btnList0">

                        <i class="fas fa-list"></i>

                        <span class="col-xs-0">Lista</span>

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="container-fluid">

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



            <?php

            /**paginacion */
			if(isset($rutas[1])){

				if(isset($rutas[2])){

					if($rutas[2] == "antiguos"){

						$modo = "ASC";

						$_SESSION["ordenar"] = "ASC";

					}else{

						$modo = "DESC";

						$_SESSION["ordenar"] = "DESC";

					}

				}else{

					$modo = $_SESSION["ordenar"];

				}

				$base = ($rutas[1] - 1)*12;

				$tope = 12;

			}else{

				$rutas[1] = 1;

				$base = 0;

				$tope = 12;

				$modo = "DESC";



			}
            /**LLAMADO DE CATEGORIAS Y SUS PRODUCTOS */

            $item1 = "ruta";

            $valor1 = $rutas[0];

            $categoria = ControladorProductos::CtrMostrarCategorias($item1, $valor1);

            $item2 = "id_categoria";

            $valor2 = $categoria["id"];

            $orden = "id";

            $base = 0;

            $tope = 12;


            $productos = ControladorProductos::ctrMostrarProductos($orden, $item2, $valor2,$base, $tope, $modo);

            $listaProductos = ControladorProductos::ctrListarProductos($orden, $item2, $valor2);



            if(!$productos){

                echo '

                <div class="container">

                <div class="col-xs-12 text-center">

                <h1><small>¡Lo sentimos!</small></h1>

                    <h2>No tenemos productos disponibles en esta categoría</h2>

                </div>

                </div>

                ';

            }else{

                echo'
                <div class="grid0">

                <div class="row">

                ';

                foreach($productos as $key => $value){

                    if($value["estado"] != 0){

                    echo'

                    <div class="card mx-auto col-xs-12 col-sm-6 col-md-3 border-0 productCard"> 
                    <a href="'.$url.$value["ruta"].'"> <img class="mx-auto img-fluid" src="'.$servidor.$value["portada"].'"/></a>
                    <div class="card-body text-center mx-auto">
                        <div class="cvp">
                            <a href="'.$url.$value["ruta"].'" class="pb-1"><h5 class="card-title font-weight-bold">'.$value["titulo"].'</a>';

                            if($value["oferta"] != 0){

                                echo'

                                <h4 class="card-text"><del><small>$ '.number_format($value["precio"], 2, '.', ',').'</del></small> $ '.number_format($value["precioOferta"], 2, '.', ',').' <small>*IVA incluido</small> </h4>

                                ';

                            }else{

                                echo'

                                <h4 class="card-text">$ '.number_format($value["precio"], 2, '.', ',').' <small>*IVA incluido</small></h4>

                                ';

                            } 

                            echo'<a href="'.$url.$value["ruta"].'" class="btn details px-auto">Ver detalles</a>
                        </div>
                    </div>
                </div>
                    ';
                } 

                }

                

                echo'


                </div>
                </div>
                <div class="list0 fluid" style="display:none">

                <div class="row">

                ';

                foreach($productos as $key => $value){
                    if($value["estado"] != 0){

                    echo'

                    <div class="col-md-12 p-3">
                        <div class="card card-body mx-auto w-100">
                            <div
                                class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0"> 
                                <a href="'.$url.$value["ruta"].'"><img src="'.$servidor.$value["portada"].'" width="150" height="150" alt=""></a>
                                </div>
                                <div class="media-body">
                                <h6 class="media-title font-weight-semibold"><a href="'.$url.$value["ruta"].'" data-abc="true">'.$value["titulo"].'</a></h6>
                                    <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                        <li class="list-inline-item"><span class="badge badge-secondary">Nuevo</span></li>
                                    </ul>
                                    <p class="mb-3"><p class="mb-3">'.$value["titular"].'</p>
                                </div>
                                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">';

                                    if($value["oferta"] != 0){

                                        echo'

                                        <h4 class="mb-0"><del><small>$ '.number_format($value["precio"], 2, '.', ',').'</del></small> $ '.number_format($value["precioOferta"], 2, '.', ',').'<small>*IVA incluido</small>  </h4>

                                        ';

                                    }else{

                                       echo'

                                       <h4 class="mb-0 font-weight-semibold">$ '.number_format($value["precio"], 2, '.', ',').'<small>*IVA incluido</small> </h4>

                                       '; 

                                    }
            
                                 echo'   <a href="'.$url.$value["ruta"].'" class="btn details px-auto"><i class="icon-cart-add mr-2"></i> Ver detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    ';

                    }

                }



                echo'

              

                </div>
                </div>

                ';

            }



        

        ?>

            <div class="clearfix"></div>

        

            <div class="container">

                <div class="row">







            <div class="col-xs-12 mx-auto p-4">



                <!--=====================================

			PAGINACIÓN

			======================================-->



            <?php



                if(count($listaProductos) != 0){



                    $pagProductos = ceil(count($listaProductos)/12);



                    if($pagProductos > 4){



                        /*=============================================

                        LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG

                        =============================================*/



                        if($rutas[1] == 1){



                            echo '

                            <nav>

                            <ul class="pagination justify-content-center">';

                            

                            for($i = 1; $i <= 4; $i ++){



                                echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';



                            }



                            echo ' <li class="disabled page-item"><a class="page-link">...</a></li>

                                <li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>

                                <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/2"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>



                            </ul>';



                        }



                        /*=============================================

                        LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO

                        =============================================*/



                        else if($rutas[1] != $pagProductos && 

                                $rutas[1] != 1 &&

                                $rutas[1] <  ($pagProductos/2) &&

                                $rutas[1] < ($pagProductos-3)

                                ){



                                $numPagActual = $rutas[1];



                                echo '<ul class="pagination">

                                    <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';

                            

                                for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){



                                    echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';



                                }



                                echo ' <li class="page-item disabled"><a class="page-link">...</a></li>

                                    <li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>

                                    <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>



                                </ul>';



                        }



                        /*=============================================

                        LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA

                        =============================================*/



                        else if($rutas[1] != $pagProductos && 

                                $rutas[1] != 1 &&

                                $rutas[1] >=  ($pagProductos/2) &&

                                $rutas[1] < ($pagProductos-3)

                                ){



                                $numPagActual = $rutas[1];

                            

                                echo '<ul class="pagination">

                                <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 

                                <li class="page-item" id="item1"><a class="page-link" href="'.$url.$rutas[0].'/1">1</a></li>

                                <li class="page-item disabled"><a class="page-link">...</a></li>

                                ';

                            

                                for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){



                                    echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';



                                }





                                echo '  <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

                                    </ul>';

                        }



                        /*=============================================

                        LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG

                        =============================================*/



                        else{



                            $numPagActual = $rutas[1];



                            echo '<ul class="pagination">

                                <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 

                                <li class="page-item" id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>

                                <li class="page-item disabled"><a>...</a></li>

                                ';

                            

                            for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){



                                echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';



                            }



                            echo ' </ul>';



                        }



                    }else{



                        echo '<ul class="pagination">';

                        

                        for($i = 1; $i <= $pagProductos; $i ++){



                            echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';



                        }



                        echo '

                        </ul>

                        </nav>

                        ';



                    }



                }



            ?>



            </div>

            </div>

            </div>





        </div>

    </div>

</div>