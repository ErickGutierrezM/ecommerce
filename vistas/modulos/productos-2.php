<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>
<div class="container">
    <div class="text-center mx-auto">
        <h1>ANDAMIOS</h1>
    </div>
</div>
<div class="container-fluid mx-auto mt-4">
    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-3 text-center p-5" style="background-color: #000000;">
            <div class="box">
                <p>class="col-xs-12 col-sm-6 col-md-3"</p>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 text-center p-5" style="background-color: #f9dd00;">
            <div class="box">
                <p>class="col-xs-12 col-sm-6 col-md-6"</p>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-3 text-center p-5" style="background-color: #000000;">
            <div class="box">
                <p>class="col-xs-12 col-sm-12 col-md-3"</p>
            </div>
        </div>

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
                        <a class="dropdown-item" href="#">Más reciente</a>
                        <a class="dropdown-item" href="#">Más antiguo</a>
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

<div class="container-fluid productos">
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
$item1 = "ruta";
$valor1 = $rutas[0];

$categoria = ControladorProductos::CtrMostrarCategorias($item1, $valor1);

$item2 = "id_categoria";
$valor2 = $categoria["id"];



$orden = "id";
$base = 0;
$tope = 12;

$productos = ControladorProductos::ctrMostrarProductos($orden, $item2, $valor2,$base, $tope);

if(!$productos){
    echo '
    <div class="col-xs-12 text-center">
    <h1><small>¡Lo sentimos!</small></h1>
        <h2>No tenemos productos disponibles en esta categoría</h2>
    </div>
    ';
}else{
    echo'
    <div class="row grid0">';
    foreach($productos as $key => $value){
        echo'
        <div class="card mx-auto col-xs-12 col-sm-6 col-md-3 border-0 productCard"> 
            <a href="'.$value["ruta"].'"> <img class="mx-auto img-fluid" src="'.$servidor.$value["portada"].'" /></a>
            <div class="card-body text-center mx-auto">
                <div class="cvp">
                   <a href="'.$value["ruta"].'"> <h5 class="card-title font-weight-bold">'.$value["titulo"].' ';
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
                     
                    
                    echo' <a href="'.$value["ruta"].'" class="btn details px-auto">Ver detalles</a>

                </div>
            </div>
        </div>
        
        ';
    }
    echo'</div>';

    echo'
    <div class=" row list0" style="display:none">

    ';

    foreach ($productos as $key => $value){

        echo'
        <div class="col-md-12">
        <div class="card card-body mx-auto">
            <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                <div class="mr-2 mb-3 mb-lg-0"><a href="'.$value["ruta"].'"> <img src="'.$servidor.$value["portada"].'" width="150"
                        height="150" alt=""></a> </div>
                <div class="media-body">
                    <h6 class="media-title font-weight-semibold"> <a href="'.$value["ruta"].'" data-abc="true">'.$value["titulo"].'</a> </h6>';
                    if($value["nuevo"] !=0){

                   echo'<ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                        <li class="list-inline-item"><span class="badge badge-secondary">Nuevo</span></li>
                    </ul>';
                    }
                    echo'
                    <p class="mb-3">'.$value["titular"].'</p>';
                  echo'  
                </div>';
                echo'
                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">';
                if($value["oferta"] != 0){
                    echo'
                    <p class="mb-0"><del><small>$ '.number_format($value["precio"], 2, '.', ',').'</del></small> $ '.number_format($value["precioOferta"], 2, '.', ',').'</p>
                    ';
                }else{
                   echo'
                   <p class="mb-0 font-weight-semibold">$ '.number_format($value["precio"], 2, '.', ',').'</p>
                   '; 
                }
                echo'
                    <a href="'.$value["ruta"].'" class="btn details px-auto"><i class="icon-cart-add mr-2"></i> Ver
                        detalles</a>
                </div>
            </div>
        </div>
    </div>
        ';
        
    }


}

?>

    </div>
</div>
</div>