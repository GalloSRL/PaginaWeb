<?php



require_once "conexion.php";



class ModeloTicketsCord{
	/*=============================================
	MOSTRAR Tickets
	=============================================*/
	static public function mdlMostrarTicketsCord($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and borrado = 0");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT T0.id,T0.nro_ticket,T0.problema,T0.tipo_problema,T0.prioridad,T0.fecha_solicitud,T0.fecha_fin_trabajo, 
			CASE
				WHEN T0.solicitado_por REGEXP '^[0-9]+$' THEN T1.nombre_user ELSE T0.solicitado_por
			END as solicitado ,T0.asignado_a,T0.id_sucursal,T0.comentarios,T0.estado FROM tickets T0 LEFT JOIN usuarios T1 ON T0.solicitado_por = T1.id WHERE T0.borrado = 0 Order By T0.fecha_solicitud desc");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}	
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarTicketsTec($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT T0.id,T0.nro_ticket,T0.problema,T0.tipo_problema,T0.prioridad,T0.fecha_solicitud,T0.fecha_fin_trabajo, 
			CASE
				WHEN T0.solicitado_por REGEXP '^[0-9]+$' THEN T1.nombre_user ELSE T0.solicitado_por
			END as solicitado ,T0.asignado_a,T0.id_sucursal,T0.comentarios,T0.estado FROM tickets T0 LEFT JOIN usuarios T1 ON T0.solicitado_por = T1.id WHERE $item = :$item and borrado = 0");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT T0.id,T0.nro_ticket,T0.problema,T0.tipo_problema,T0.prioridad,T0.fecha_solicitud,T0.fecha_fin_trabajo, 
			CASE
				WHEN T0.solicitado_por REGEXP '^[0-9]+$' THEN T1.nombre_user ELSE T0.solicitado_por
			END as solicitado ,T0.asignado_a,T0.id_sucursal,T0.comentarios,T0.estado FROM tickets T0 LEFT JOIN usuarios T1 ON T0.solicitado_por = T1.id WHERE T0.borrado = 0 Order By T0.fecha_solicitud desc");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}	
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR Año Tickets
	=============================================*/
	static public function MdlAñoTickets($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT YEAR(fecha_solicitud) as year FROM $tabla WHERE borrado = 0 GROUP BY year");
		$stmt -> execute();
		return $stmt -> fetchAll();	
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
	MOSTRAR Mes Tickets
	=============================================*/
	static public function MdlMesTickets($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT MONTH(fecha_solicitud) as mes FROM $tabla WHERE borrado = 0 GROUP BY mes");

		$stmt -> execute();

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;

	}

	/*============================================
	MOSTRAR Tickets por año y mes
	=============================================*/
	static public function MdlMostrarAñoMesTickets($tabla, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE YEAR(fecha_solicitud) = $valor1 and MONTH(fecha_solicitud) = $valor2 and borrado = 0");

		$stmt -> execute();

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR Tickets por año
	=============================================*/
	static public function MdlMostrarAñoTickets($tabla, $valor1){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE YEAR(fecha_solicitud) = $valor1 and borrado = 0");

		$stmt -> execute();

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE Ticket
	=============================================*/
	static public function mdlIngresarTicketCord($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nro_ticket, problema, tipo_problema, prioridad, solicitado_por, asignado_a, id_sucursal, tiempo) 
														VALUES (:nro_ticket, :problema, :tipo_problema, :prioridad, :solicitado_por, :asignado_a, :id_sucursal, :tiempo)");
		$stmt->bindParam(":nro_ticket", $datos["nro_ticket"], PDO::PARAM_INT);
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_problema", $datos["tipo_problema"], PDO::PARAM_STR);
		$stmt->bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_STR);
		$stmt->bindParam(":solicitado_por", $datos["solicitado_por"], PDO::PARAM_STR);
		$stmt->bindParam(":asignado_a", $datos["asignado_a"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR Ticket
	=============================================*/
	static public function mdlEditarTicketCord($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET problema = :problema, tipo_problema = :tipo_problema, prioridad = :prioridad, solicitado_por = :solicitado_por, asignado_a = :asignado_a, id_sucursal = :id_sucursal, tiempo = :tiempo WHERE id = :id");
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_problema", $datos["tipo_problema"], PDO::PARAM_STR);
		$stmt->bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_STR);
		$stmt->bindParam(":solicitado_por", $datos["solicitado_por"], PDO::PARAM_STR);
		$stmt->bindParam(":asignado_a", $datos["asignado_a"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
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
	EDITAR Ticket Estado
	=============================================*/
	static public function mdlEditarTicketEstadoCord($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  fecha_fin_trabajo = :fecha_fin_trabajo, comentarios = :comentarios, estado = :estado  WHERE id = :id");
		$stmt->bindParam(":fecha_fin_trabajo", $datos["fecha_fin_trabajo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
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
	ACTUALIZAR Tickets
	=============================================*/
	static public function mdlActualizarTicketCord($tabla, $item1, $valor1, $item2, $valor2){
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
	BORRAR Ticket
	=============================================*/
	static public function mdlBorrarTicketCord($tabla, $datos){
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