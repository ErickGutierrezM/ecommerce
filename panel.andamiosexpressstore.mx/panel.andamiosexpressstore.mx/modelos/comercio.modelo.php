<?php

require_once "conexion.php";



class ModeloComercio{

	/*=============================================
	SELECCIONAR COMERCIO
	=============================================*/

	static public function mdlSeleccionarComercio($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}