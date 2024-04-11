<?php

require_once "conexion.php";

class ModeloProductos{
	/*=============================================
	MOSTRAR Productos
	=============================================*/
	static public function mdlMostrarProductos($tabla, $item, $valor){
		if($item != null){
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
	MOSTRAR Productos
	=============================================*/
	static public function mdlMostrarTodosProductos($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item > :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	REGISTRO DE ProductoS
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_producto, descripcion_producto, imagen_producto, id_user) VALUES (:nombre_producto, :descripcion_producto, :imagen_producto, :id_user)");
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR Producto
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre_producto, descripcion_producto = :descripcion_producto, imagen_producto = :imagen_producto WHERE id = :id");

		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);
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
	BORRAR Producto
	=============================================*/

	static public function mdlBorrarProducto($tabla, $datos){

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