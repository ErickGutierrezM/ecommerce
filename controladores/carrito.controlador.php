<?php

class ControladorCarrito{

    /**MOSTRAR TARIFAS */

   static public function ctrMostrarTarifas(){

        $tabla = "comercio";



        $respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);



        return $respuesta;



    }


    /**nuevas compras */

    static public function ctrNuevasCompras($datos){

        $tabla = "compras";

        $respuesta = ModeloCarrito::mdlNuevasCompras($tabla, $datos);

        if($respuesta == "ok"){

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVAS VENTAS
			=============================================*/

			$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

			$nuevaVenta = $traerNotificaciones["nuevasVentas"] + 1;

			ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevasVentas", $nuevaVenta);


		}

        return $respuesta;

    }

}