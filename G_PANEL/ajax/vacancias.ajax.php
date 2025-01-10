<?php

require_once "../controladores/vacancia.controlador.php";
require_once "../modelos/vacancia.modelo.php";

class AjaxVacancias{

	/*=============================================
	EDITAR VACANCIA
	=============================================*/	

	public $idVacancia;

	public function ajaxEditarVacancia(){

		$item = "id";
		$valor = $this->idVacancia;

		$respuesta = ControladorVacancias::ctrMostrarVacancias($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VER VACANCIA DE LA WEB
	=============================================*/
	public $estadoVacancia;

	public function ajaxVerVacancia(){

		$item = 'estado';
		$valor = $this->estadoVacancia;

		$respuesta = ControladorVacancias::ctrMostrarVacancias($item, $valor);
		
        echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR VACANCIA
	=============================================*/	

	public $activarVacancia;
	public $activarId;


	public function ajaxActivarVacancia(){

		$tabla = "vacancias";

		$item1 = "estado";
		$valor1 = $this->activarVacancia;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloVacancias::mdlActualizarVacancia($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR VACANCIA
=============================================*/
if(isset($_POST["idVacancia"])){

	$editar = new AjaxVacancias();
	$editar -> idVacancia = $_POST["idVacancia"];
	$editar -> ajaxEditarVacancia();

}

/*=============================================
VER VACANCIA
=============================================*/
if(isset($_POST["estadoVacancia"])){

	$ver = new AjaxVacancias();
	$ver -> estadoVacancia = $_POST["estadoVacancia"];
	$ver -> ajaxVerVacancia();

}

/*=============================================
ACTIVAR VACANCIA
=============================================*/	

if(isset($_POST["activarVacancia"])){

	$activarVacancia = new AjaxVacancias();
	$activarVacancia -> activarVacancia = $_POST["activarVacancia"];
	$activarVacancia -> activarId = $_POST["activarId"];
	$activarVacancia -> ajaxActivarVacancia();

}