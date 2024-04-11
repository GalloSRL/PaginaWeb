<?php

require_once "conexion.php";

class ModeloClientes{
	/*=============================================
	MOSTRAR Clientes
	=============================================*/
	static public function mdlMostrarClientes($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status = 1");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}	
		$stmt -> close();
		$stmt = null;
	}

}