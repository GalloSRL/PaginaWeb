<?php

require_once "../controladores/rol.controlador.php";
require_once "../modelos/rol.modelo.php";

class AjaxRoles{

	/*=============================================
	EDITAR ROL
	=============================================*/	

	public $idRol;

	public function ajaxEditarRol(){

		$item = "id";
		$valor = $this->idRol;

		$respuesta = ControladorRoles::ctrMostrarRoles($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR Rol
=============================================*/
if(isset($_POST["idRol"])){

	$editar = new AjaxRoles();
	$editar -> idRol = $_POST["idRol"];
	$editar -> ajaxEditarRol();

}