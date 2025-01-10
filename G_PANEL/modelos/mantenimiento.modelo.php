<?php



require_once "conexion.php";



class ModeloMantenimientos{

	

	/*=============================================

	MOSTRAR MANTENIMIENTOS

	=============================================*/

	static public function mdlMostrarMantenimientos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and borrado = 0");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE borrado = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}	

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================

	REGISTRO DE MANTENIMIENTO

	=============================================*/

	static public function mdlIngresarMantenimiento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_realizada, sucursal, seccion, tipo_equipo, usuario, responsable_realizacion, nro_factura, detalle, referencia, proxima_revision, estado) VALUES (:fecha_realizada, :sucursal, :seccion, :tipo_equipo, :usuario, :responsable_realizacion, :nro_factura, :detalle, :referencia, :proxima_revision, 'Pendiente')");

		$stmt->bindParam(":fecha_realizada", $datos["fecha_realizada"], PDO::PARAM_STR);

        $stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);

		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);

		$stmt->bindParam(":tipo_equipo", $datos["tipo_equipo"], PDO::PARAM_STR);

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		$stmt->bindParam(":responsable_realizacion", $datos["responsable_realizacion"], PDO::PARAM_STR);

        $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);

        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);

        $stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_STR);

        $stmt->bindParam(":proxima_revision", $datos["proxima_revision"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}



	/*=============================================

	EDITAR MANTENIMIENTO CON REFERENCIA

	=============================================*/



	static public function mdlEditarMantenimiento($tabla, $datos){

	

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_realizada=:fecha_realizada,sucursal=:sucursal, seccion = :seccion, tipo_equipo = :tipo_equipo, usuario = :usuario, responsable_realizacion = :responsable_realizacion, nro_factura = :nro_factura, detalle = :detalle, referencia = :referencia, proxima_revision = :proxima_revision WHERE id = :id");

		$stmt->bindParam(":fecha_realizada", $datos["fecha_realizada"], PDO::PARAM_STR);

        $stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);

		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);

		$stmt->bindParam(":tipo_equipo", $datos["tipo_equipo"], PDO::PARAM_STR);

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		$stmt->bindParam(":responsable_realizacion", $datos["responsable_realizacion"], PDO::PARAM_STR);

        $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);

        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);

        $stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_STR);

        $stmt->bindParam(":proxima_revision", $datos["proxima_revision"], PDO::PARAM_STR);

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

	EDITAR MANTENIMIENTO CON REFERENCIA

	=============================================*/



	static public function mdlEditarMantenimientoRef($tabla, $datos){

	

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

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

	BORRAR Mantenimiento

	=============================================*/



	static public function mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2){



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





}