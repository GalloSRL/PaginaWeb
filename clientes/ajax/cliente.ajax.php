<?php

require_once "../controlador/datos-clientes.controlador.php";
require_once "../modelo/datos-clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTES
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorDatosClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VER Distrito por Departamento
	=============================================*/	

	public $idDepartamento;

	public function ajaxVerDistrito(){

		$item = "id_departamento";
		$valor = $this->idDepartamento;

		$respuesta = ControladorDatosClientes::ctrMostrarDistrito($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VER Barrio por Distrito
	=============================================*/	

	public $idDistrito;

	public function ajaxVerBarrio(){

		$item = "id_distrito";
		$valor = $this->idDistrito;

		$respuesta = ControladorDatosClientes::ctrMostrarBarrio($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	/*public $activarUsuario;
	public $activarId;


	public function ajaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}*/

	/*=============================================
	VALIDAR NO REPETIR CLIENTE
	=============================================*/	

	public $validarCliente;

	public function ajaxValidarCliente(){

		$item = "lictradnum";
		$valor = $this->validarCliente;

		$respuesta = ControladorDatosClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/
if(isset($_POST["idCliente"])){

	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

/*if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}*/

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/
if(isset( $_POST["validarCliente"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarCliente"];
	$valCliente -> ajaxValidarCliente();

}

/*=============================================
VERIFICAR DISTRITO POR DEPARTAMENTO
=============================================*/
if(isset( $_POST["idDepartamento"])){

	$departamento = new AjaxClientes();
	$departamento -> idDepartamento = $_POST["idDepartamento"];
	$departamento -> ajaxVerDistrito();

}

/*=============================================
VERIFICAR BARRIO POR DISTRITO
=============================================*/
if(isset( $_POST["idDistrito"])){

	$distrito = new AjaxClientes();
	$distrito -> idDistrito = $_POST["idDistrito"];
	$distrito -> ajaxVerBarrio();

}