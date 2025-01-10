<?php



require_once "conexion.php";



class ModeloVacancias{

	/*=============================================

	MOSTRAR Vacancias

	=============================================*/

	static public function mdlMostrarVacancias($tabla, $item, $valor){

		if($item == 'estado'){

			$stmt = Conexion::conectar()->prepare("SELECT count(*) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

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

	MOSTRAR VACANCIAS POR ESTADO

	=============================================*/

	static public function mdlMostrarVacanciasEstado($tabla, $item, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by fecha_inicio asc, fecha_fin asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll(); 

		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================

	REGISTRO DE VACANCIAS

	=============================================*/

	static public function mdlIngresarVacancia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(vacancia, perfil, ofrece, valora, lugar_vacancia, fecha_inicio, fecha_fin, flyer) VALUES (:vacancia, :perfil, :ofrece, :valora, :lugar_vacancia, :fecha_inicio, :fecha_fin, :flyer)");

		$stmt->bindParam(":vacancia", $datos["vacancia"], PDO::PARAM_STR);

		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);

		$stmt->bindParam(":ofrece", $datos["ofrece"], PDO::PARAM_STR);

		$stmt->bindParam(":valora", $datos["valora"], PDO::PARAM_STR);

		$stmt->bindParam(":lugar_vacancia", $datos["lugar_vacancia"], PDO::PARAM_STR);

		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);

		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);

		$stmt->bindParam(":flyer", $datos["flyer"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}



	/*=============================================

	EDITAR VACANCIAS

	=============================================*/



	static public function mdlEditarVacancia($tabla, $datos){

	

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET vacancia = :vacancia, perfil = :perfil, ofrece = :ofrece, valora = :valora, lugar_vacancia = :lugar_vacancia, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, flyer = :flyer WHERE id = :id");



		$stmt -> bindParam(":vacancia", $datos["vacancia"], PDO::PARAM_STR);

		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);

		$stmt -> bindParam(":ofrece", $datos["ofrece"], PDO::PARAM_STR);

		$stmt -> bindParam(":valora", $datos["valora"], PDO::PARAM_STR);

		$stmt -> bindParam(":lugar_vacancia", $datos["lugar_vacancia"], PDO::PARAM_STR);

		$stmt -> bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);

		$stmt -> bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);

		$stmt->bindParam(":flyer", $datos["flyer"], PDO::PARAM_STR);

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

	CONTEO DE POSTULANTES RECIBIDOS

	=============================================*/



	static public function mdlMostrarConteoPostulantes($tabla, $item, $valor){



		$stmt = Conexion::conectar()->prepare("SELECT conteo_postulante FROM $tabla  WHERE $item = :$item and estado = 1");



		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);



		if($stmt -> execute()){



			return "ok";

		

		}else{



			return "error";	



		}



		$stmt -> close();



		$stmt = null;



	}



	/*=============================================

	SUMA DE POSTULACIONES

	=============================================*/



	static public function mdlMostrarSumaPostulaciones($tabla, $item, $valor){



		$stmt = Conexion::conectar()->prepare("SELECT SUM(conteo_postulaciones) as 'sumPostulaciones' FROM $tabla WHERE estado = 1");

		$stmt -> execute();

		return $stmt -> fetch(); 

		

		$stmt -> close();

		$stmt = null;



	}



	/*=============================================

	ACTIVAR VACANCIA

	=============================================*/



	static public function mdlActualizarVacancia($tabla, $item1, $valor1, $item2, $valor2){



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

	BORRAR VACANCIA

	=============================================*/



	static public function mdlBorrarVacancia($tabla, $datos){



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