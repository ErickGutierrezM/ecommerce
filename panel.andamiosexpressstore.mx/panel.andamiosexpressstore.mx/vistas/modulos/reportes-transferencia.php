<?php

require_once "../../controladores/reportes-transferencia.controlador.php";

require_once "../../modelos/reportes-transferencia.modelo.php";

$reportet = new ControladorReportesTransferencia();
$reportet -> ctrDescargarReporteTransferencia();