<?php

class ControladorComercio{

    /**SELECCIONAR COMERCIO */
    static public function ctrSeleccionarComercio(){
        $tabla = "comercio";
        $respuesta = ModeloComercio::mdlSeleccionarComercio($tabla);

        return $respuesta;

    }

}

