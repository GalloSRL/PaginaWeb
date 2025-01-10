<?php

require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

class AjaxMantenimientos{

	/*=============================================
	EDITAR MANTENIMIENTO
	=============================================*/	

	public $idMantenimiento;

	public function ajaxEditarMantenimiento(){

		$item = "id";
		$valor = $this->idMantenimiento;

		$respuesta = ControladorMantenimientos::ctrMostrarMantenimientos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	BUSCAR MANTENIMIENTO
	=============================================*/	

	public $idMante;

	public function ajaxBuscarMantenimiento(){

		$item = "referencia";
		$valor = $this->idMante;

		$respuesta = ControladorMantenimientos::ctrMostrarMantenimientosRefe($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	Borrado Mantenimiento
	=============================================*/	

	public $BorradoMantenimiento;
	public $BorradoId;


	public function ajaxBorradoMantenimiento(){

		$tabla = "mantenimiento";

		$item1 = "borrado";
		$valor1 = $this->BorradoMantenimiento;

		$item2 = "id";
		$valor2 = $this->BorradoId;

		$respuesta = ModeloMantenimientos::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR MANTENIMIENTO
=============================================*/
if(isset($_POST["idMantenimiento"])){
	$editar = new AjaxMantenimientos();
	$editar -> idMantenimiento = $_POST["idMantenimiento"];
	$editar -> ajaxEditarMantenimiento();

}

/*=============================================
BUSCAR MANTENIMIENTO POR REFERENCIA
=============================================*/

if(isset($_POST["idMante"])){
	$buscar = new AjaxMantenimientos();
	$buscar -> idMante = $_POST["idMante"];
	$buscar -> ajaxBuscarMantenimiento();

}

/*=============================================
BORRAR MANTENIMIENTO
=============================================*/
if(isset($_POST["BorradoMantenimiento"])){
	$Borrado = new AjaxMantenimientos();
	$Borrado -> BorradoId = $_POST["BorradoId"];
	$Borrado -> BorradoMantenimiento = $_POST["BorradoMantenimiento"];
	$Borrado -> ajaxBorradoMantenimiento();

}

