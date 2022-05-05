<?php

$servidor = Ruta::ctrRutaServidor();
/**ARREGLO PARA IDENTIFICAR EL ORDEN DE LOS PRODUCTOS ((DINAMICO)) */

// $titulos = array("ARTICULOS GRATIS", "PRODUCTOS MÁS COMPRADOS", "LO MÁS VISTOS");

// if($titulos[0] == "ARTICULOS GRATIS"){
//     $orden = "id";
//     $gratis = ControladorProductos::ctrMostrarProductos($orden);
// }
// if($titulos[1] == "PRODUCTOS MÁS COMPRADOS"){
//     $orden = "ventas";
//     $ventas = ControladorProductos::ctrMostrarProductos($orden);
// }
// if($titulos[2] == "LO MÁS VISTOS"){
//     $orden = "vistas";
//     $vistas = ControladorProductos::ctrMostrarProductos($orden);
// }
$titulos = array("PRODUCTOS MÁS COMPRADOS");

$base = 0;
$tope = 4;

if($titulos[0] == "PRODUCTOS MÁS COMPRADOS"){
    $orden = "ventas";
    $modo = "DESC";
    $valor = 1;
    $item = "estado";

    $ventas = ControladorProductos::ctrMostrarProductos($orden, $item, $valor, $base, $tope, $modo);
}

//lo mismo para ambas opciones

$modulos = array($ventas); //aqui se agregan las variables en caso de tener mas modulos


/**ciclo para validar la cantidad de comparaciones para filtar los resultados */

for($i = 0; $i < count($titulos); $i++){
    echo '
    <div class="container p-4">
        <div class="col-xs-12 titulo text-center">
            <div class="col-xs-12">
            <h1>'.$titulos[$i].'</h1>
            </div>
        </div>
        <div class="row">';
        foreach($modulos[$i] as $key => $value){

            if($value["estado"] != 0){
            echo'
            <div class="card mx-auto col-xs-12 col-sm-6 col-md-3 border-0 productCard"> 
            <a href="'.$value["ruta"].'"><img class="mx-auto img-fluid" src="'.$servidor.$value["portada"].'" style="height:318px;" /></a>
                <div class="card-body text-center mx-auto">
                    <div class="cvp">
                       <a href="'.$value["ruta"].'"> <h5 class="card-title font-weight-bold">'.$value["titulo"].' ';
                       if($value["nuevo"] !=0){
                           echo'<span class="badge badge-secondary">Nuevo</span></h5></a>';
                       }
                   if($value["oferta"] != 0){
                       echo'
                       <p class="card-text">
                       <del><small>$ '.number_format($value["precio"], 2, '.', ',').'</del></small> $ '.number_format($value["precioOferta"], 2, '.', ',').' *IVA incluido </p>
                       ';
                   }else{
                    echo'
                    <p class="card-text">$ '.number_format($value["precio"], 2, '.', ',').' *IVA incluido </p>
                    ';
                   }
                         
                        
                        echo' <a href="'.$value["ruta"].'" class="btn details px-auto">Ver detalles</a>

                    </div>
                </div>
            </div>
            
            ';
            }
        }

        echo'</div>
        
</div>
    ';
}
?> 