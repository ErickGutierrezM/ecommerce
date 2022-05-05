<?php

class ControladorReportesTransferencia{
    public function ctrDescargarReporteTransferencia(){

        if(isset($_GET["reportet"])){
            $tabla = $_GET["reportet"];

            $reportet = ModeloReportesTransferencia::mdlDescargarReporteTransferencia($tabla);

            $nombre = 'reporte_transferencias.xls';

            header('Expires: 0');

			header('Cache-control: private');

			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel

			header("Cache-Control: cache, must-revalidate"); 

			header('Content-Description: File Transfer');

			header('Last-Modified: '.date('D, d M Y H:i:s'));

			header("Pragma: public"); 

			header('Content-Disposition:; filename="'.$nombre.'"');

			header("Content-Transfer-Encoding: binary");


            if($_GET["reportet"] == "ventas"){
                echo utf8_decode("

                <table border='0'> 

                    <tr> 

                        <td style='font-weight:bold; border:1px solid #eee;'>Producto</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Cliente</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Venta</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Estatus del envío</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Estatus del pago</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Forma de pago</td>

                        <td style='font-weight:bold; border:1px solid #eee;'>Correo electrónico</td>		

                        <td style='font-weight:bold; border:1px solid #eee;'>Direccion</td>		

                        <td style='font-weight:bold; border:1px solid #eee;'>Municipio</td	

                        <td style='font-weight:bold; border:1px solid #eee;'>Fecha</td>		

                    </tr>
                    ");
            }
        }
    }
}