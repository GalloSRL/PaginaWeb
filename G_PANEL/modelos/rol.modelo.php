<?php

require_once "conexion.php";

class ModeloRoles{
	/*=============================================
	MOSTRAR ROLES
	=============================================*/
	static public function mdlMostrarRoles($tabla, $item, $valor){
		if($item == 'estado_rol'){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}	
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR ROLES por SESION
	=============================================*/
	static public function mdlMostrarRolesSesion($tabla2, $item2, $valor2){
		if($item2 != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE $item2 = :$item2");
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}	
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	REGISTRO DE ROLES
	=============================================*/
	static public function mdlIngresarRol($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_rol, id_user) VALUES (:nombre_rol, :id_user)");
		$stmt->bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR ROLES
	=============================================*/

	static public function mdlEditarRol($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_rol = :nombre_rol WHERE id = :id");

		$stmt -> bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR ROLES
	=============================================*/

	static public function mdlBorrarRol($tabla, $datos, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_rol = :estado_rol WHERE id = :id");

		$stmt -> bindParam(":estado_rol",$valor, PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}