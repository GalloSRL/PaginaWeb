<?php

require_once "conexion.php";

class ModeloUsuarios{
	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	static public function mdlMostrarUsuarios($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");
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
	
	static public function mdlMostrarUsuariosRol($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
			
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/
	static public function mdlIngresarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_user, usuario_user, password_user, id_rol, email, id_user) VALUES (:nombre_user, :usuario_user, :password_user, :id_rol, :email, :id_user)");
		$stmt->bindParam(":nombre_user", $datos["nombre_user"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_user", $datos["usuario_user"], PDO::PARAM_STR);
		$stmt->bindParam(":password_user", $datos["password_user"], PDO::PARAM_STR);
		$stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
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
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_user = :nombre_user, usuario_user = :usuario_user, password_user = :password_user, id_rol = :id_rol, email = :email WHERE id = :id");
		$stmt->bindParam(":nombre_user", $datos["nombre_user"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_user", $datos["usuario_user"], PDO::PARAM_STR);
		$stmt->bindParam(":password_user", $datos["password_user"], PDO::PARAM_STR);
		$stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Contraseña
	=============================================*/

	static public function mdlEditarContraseña($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password_user = :password_user WHERE id = :id");
		$stmt->bindParam(":password_user", $datos["password_user"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	

	/*=============================================
	ACTUALIZAR CONTEO DE POSTULANTES RECIBIDOS
	=============================================*/

	static public function mdlActualizarConteoPostulantes($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

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