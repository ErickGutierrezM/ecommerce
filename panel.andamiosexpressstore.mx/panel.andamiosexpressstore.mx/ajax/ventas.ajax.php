<?php 
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas{

    /**ACTUALIZAR PROCESO DE ENVIOS Y PAGOS EN AMBAS TABLAS*/
    public $idVenta;
    public $idPagoVenta;
    public $idVentaTransferencia;
    public $idPagoVentaTransferencia;
    public $etapa;


    public function ajaxEnvioVenta(){
        $respuesta = ModeloVentas::mdlActualizarVenta("compras", "envio", $this->etapa, "id", $this->idVenta);
        echo $respuesta;
    }

    public function ajaxPagoVenta(){
        $respuesta =  ModeloVentas::mdlActualizarVenta("compras", "estatus_pago", $this->etapa, "id", $this->idPagoVenta);
        echo $respuesta;
    }
    public function ajaxEnvioVentaTranferencia(){
        $respuesta =  ModeloVentas::mdlActualizarVenta("ventas", "envio", $this->etapa, "id", $this->idVentaTransferencia);
        echo $respuesta;
    }
    public function ajaxPagoVentaTranferencia(){
        $respuesta =  ModeloVentas::mdlActualizarVenta("ventas", "estatus_pago", $this->etapa, "id", $this->idPagoVentaTransferencia);
        echo $respuesta;
    }
}
/**ACTUALIZAR PROCESO DE ENVIO */
if(isset($_POST["idVenta"])){
    $envioVenta = new AjaxVentas();
    $envioVenta -> idVenta = $_POST["idVenta"];
    $envioVenta -> etapa = $_POST["etapa"];
    $envioVenta -> ajaxEnvioVenta();
}

/**ACTUALIZAR PROCESO DE PAGO*/
if(isset($_POST["idPagoVenta"])){
    $pagoVenta = new AjaxVentas();
    $pagoVenta -> idPagoVenta = $_POST["idPagoVenta"];
    $pagoVenta -> etapa = $_POST["etapa"];
    $pagoVenta -> ajaxPagoVenta();
}

/**ACTUALIZAR PROCESO DE PAGO*/
if(isset($_POST["idVentaTransferencia"])){
    $pagoVenta = new AjaxVentas();
    $pagoVenta -> idVentaTransferencia = $_POST["idVentaTransferencia"];
    $pagoVenta -> etapa = $_POST["etapa"];
    $pagoVenta -> ajaxEnvioVentaTranferencia();
}

/**ACTUALIZAR PROCESO DE PAGO*/
if(isset($_POST["idPagoVentaTransferencia"])){
    $pagoVenta = new AjaxVentas();
    $pagoVenta -> idPagoVentaTransferencia = $_POST["idPagoVentaTransferencia"];
    $pagoVenta -> etapa = $_POST["etapa"];
    $pagoVenta -> ajaxPagoVentaTranferencia();
}

