<?php

class ControladorProductos{
    static public function CtrMostrarCategorias($item, $valor){
        $tabla = "categorias";
        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;

    }
    /**MOSTRAR LOS PRODUCTOS */
    static public function ctrMostrarProductos($orden,$item, $valor,$base, $tope, $modo)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $orden,$item, $valor,$base, $tope, $modo);

        return $respuesta;

    }
    /**MOSTRAR INFO PRODUCTO */
   static public function ctrMostrarInfoProducto($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarInfoProducto($tabla, $item, $valor);

        return $respuesta;

    }

    /**LISTAR PRODUCTOS */
    static public function ctrListarProductos($orden, $item, $valor){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlListarProductos($tabla, $orden, $item, $valor);
        return $respuesta; 

    }

    /**LISTAR PRODUCTOS */
        static public function ctrListarVentas($orden, $item, $valor){
            $tabla = "ventas";
            $respuesta = ModeloProductos::mdlListarProductos($tabla, $orden, $item, $valor);
            return $respuesta; 
    
        }

    /**mostrar banners */
    static public function CtrMostrarBanner($ruta){
        $tabla = "banner";
        $respuesta = ModeloProductos::mdlMostrarBanner($tabla, $ruta);

        return $respuesta;

    }
	/*=============================================
	ACTUALIZAR VISTA PRODUCTO
	=============================================*/

	static public function ctrActualizarProducto($item1, $valor1, $item2, $valor2){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;
	}
}