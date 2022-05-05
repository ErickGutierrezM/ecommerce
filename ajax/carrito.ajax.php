<?php

require_once "../extensiones/paypal.controlador.php";

require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxCarrito{
    /**METODO paypal */
    public $divisa;
    public $total;
    public $totalEncriptado;
    public $impuesto;
    public $envio;
    public $subtotal;
    public $tituloArray;
    public $cantidadArray;
    public $valorItemArray;
    public $idProductoArray;

    public function ajaxEnviarPaypal(){

        if(md5($this->total) == $this->totalEncriptado){

            $datos = array(
                "divisa"=>$this->divisa,
                "total"=>$this->total,
                "impuesto"=>$this->impuesto,
                "envio"=>$this->envio,
                "subtotal"=>$this->subtotal,
                "tituloArray"=>$this->tituloArray,
                "cantidadArray"=>$this->cantidadArray,
                "valorItemArray"=>$this->valorItemArray,
                "idProductoArray"=>$this->idProductoArray,
            );
            $respuesta = Paypal::mdlPagoPaypal($datos);
            echo $respuesta;
        }
            // $datos = array(
            //     "divisa"=>$this->divisa,
            //     "total"=>$this->total,
            //     "impuesto"=>$this->impuesto,
            //     "envio"=>$this->envio,
            //     "subtotal"=>$this->subtotal,
            //     "tituloArray"=>$this->tituloArray,
            //     "cantidadArray"=>$this->cantidadArray,
            //     "valorItemArray"=>$this->valorItemArray,
            //     "idProductoArray"=>$this->idProductoArray,
            // );
            // $respuesta = Paypal::mdlPagoPaypal($datos);
            // echo $respuesta;
    }

    public function ajaxEnviarTransferencia(){

            $datos = array(
                "divisa"=>$this->divisa,
                "total"=>$this->total,
                "impuesto"=>$this->impuesto,
                "envio"=>$this->envio,
                "subtotal"=>$this->subtotal,
                "tituloArray"=>$this->tituloArray,
                "cantidadArray"=>$this->cantidadArray,
                "valorItemArray"=>$this->valorItemArray,
                "idProductoArray"=>$this->idProductoArray,
            );
            $respuesta = ControladorCarrito::ctrNuevasComprasTransferencia($datos);
            echo $respuesta;

    }
}
/**METODO PAYPAL */
if(isset($_POST["divisa"])){


    $paypal = new AjaxCarrito();
    $paypal ->divisa = $_POST["divisa"];
    $paypal ->total = $_POST["total"];
    $paypal ->totalEncriptado = $_POST["totalEncriptado"];
    $paypal ->impuesto = $_POST["impuesto"];
    $paypal ->envio = $_POST["envio"];
    $paypal ->subtotal = $_POST["subtotal"];
    $paypal ->tituloArray = $_POST["tituloArray"];
    $paypal ->cantidadArray = $_POST["cantidadArray"];
    $paypal ->valorItemArray = $_POST["valorItemArray"];
    $paypal ->idProductoArray = $_POST["idProductoArray"];
    $paypal -> ajaxEnviarPaypal();
}

/**METODO PAYPAL */
if(isset($_POST["divisa"])){

    $transferencia = new AjaxCarrito();
    $transferencia ->divisa = $_POST["divisa"];
    $transferencia ->total = $_POST["total"];
    $transferencia ->totalEncriptado = $_POST["totalEncriptado"];
    $transferencia ->impuesto = $_POST["impuesto"];
    $transferencia ->envio = $_POST["envio"];
    $transferencia ->subtotal = $_POST["subtotal"];
    $transferencia ->tituloArray = $_POST["tituloArray"];
    $transferencia ->cantidadArray = $_POST["cantidadArray"];
    $transferencia ->valorItemArray = $_POST["valorItemArray"];
    $transferencia ->idProductoArray = $_POST["idProductoArray"];

    $transferencia ->ajaxEnviarTransferencia();


}

