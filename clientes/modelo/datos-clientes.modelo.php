<?php

require_once "conexion.php";

class ModeloDatosClientes{
	/*=============================================
	REGISTRO DE CLIENTES
	=============================================*/
	static public function mdlIngresarCliente($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(u_tipcont, u_crid, lictradnum, cardname, u_crsi, e_mail, phone, address, Street, AdresType, StreetNo, U_EXX_FE_DEPT, U_EXX_FE_DIST, U_EXX_FE_BALO) VALUES (:u_tipcont, :u_crid, :lictradnum, :cardname, :u_crsi, :e_mail, :phone, :address, :Street, :AdresType, :StreetNo, :U_EXX_FE_DEPT, :U_EXX_FE_DIST, :U_EXX_FE_BALO)");
		$stmt->bindParam(":u_tipcont", $datos["u_tipcont"], PDO::PARAM_INT);
		$stmt->bindParam(":u_crid", $datos["u_crid"], PDO::PARAM_STR);
		$stmt->bindParam(":lictradnum", $datos["lictradnum"], PDO::PARAM_STR);
		$stmt->bindParam(":cardname", $datos["cardname"], PDO::PARAM_STR);
		$stmt->bindParam(":u_crsi", $datos["u_crsi"], PDO::PARAM_STR);
		$stmt->bindParam(":e_mail", $datos["e_mail"], PDO::PARAM_STR);
		$stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
		$stmt->bindParam(":address", $datos["address"], PDO::PARAM_STR);
		$stmt->bindParam(":Street", $datos["Street"], PDO::PARAM_STR);
		$stmt->bindParam(":AdresType", $datos["AdresType"], PDO::PARAM_STR);
		$stmt->bindParam(":StreetNo", $datos["StreetNo"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_DEPT", $datos["U_EXX_FE_DEPT"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_DIST", $datos["U_EXX_FE_DIST"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_BALO", $datos["U_EXX_FE_BALO"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

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
	ACTUALIZACIÓN DE CLIENTES
	=============================================*/
	static public function mdlEditarCliente($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET u_tipcont = :u_tipcont, u_crid = :u_crid, lictradnum = :lictradnum, cardname = :cardname, u_crsi = :u_crsi, e_mail = :e_mail, phone = :phone, address = :address, Street = :Street, AdresType = :AdresType, StreetNo = :StreetNo, U_EXX_FE_DEPT = :U_EXX_FE_DEPT, U_EXX_FE_DIST = :U_EXX_FE_DIST, U_EXX_FE_BALO = :U_EXX_FE_BALO , status = 1 WHERE  id = :id");
		$stmt->bindParam(":u_tipcont", $datos["u_tipcont"], PDO::PARAM_INT);
		$stmt->bindParam(":u_crid", $datos["u_crid"], PDO::PARAM_STR);
		$stmt->bindParam(":lictradnum", $datos["lictradnum"], PDO::PARAM_STR);
		$stmt->bindParam(":cardname", $datos["cardname"], PDO::PARAM_STR);
		$stmt->bindParam(":u_crsi", $datos["u_crsi"], PDO::PARAM_STR);
		$stmt->bindParam(":e_mail", $datos["e_mail"], PDO::PARAM_STR);
		$stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
		$stmt->bindParam(":address", $datos["address"], PDO::PARAM_STR);
		$stmt->bindParam(":Street", $datos["Street"], PDO::PARAM_STR);
		$stmt->bindParam(":AdresType", $datos["AdresType"], PDO::PARAM_STR);
		$stmt->bindParam(":StreetNo", $datos["StreetNo"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_DEPT", $datos["U_EXX_FE_DEPT"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_DIST", $datos["U_EXX_FE_DIST"], PDO::PARAM_INT);
		$stmt->bindParam(":U_EXX_FE_BALO", $datos["U_EXX_FE_BALO"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR Departamento
	=============================================*/

	static public function mdlMostrarDepartamento($tabla, $item, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR Distrito
	=============================================*/

	static public function mdlMostrarDistrito($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR Barrio
	=============================================*/

	static public function mdlMostrarBarrio($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

}