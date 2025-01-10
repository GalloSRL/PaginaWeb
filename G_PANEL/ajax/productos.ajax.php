<?php

require_once "../controladores/producto.controlador.php";
require_once "../modelos/producto.modelo.php";

class AjaxProductos{

	/*=============================================
	EDITAR Producto
	=============================================*/	

	public $idProducto;

	public function ajaxEditarProducto(){

		$item = "id";
		$valor = $this->idProducto;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);

	}

	public $id;

	public function ajaxVerProducto(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorProductos::ctrMostrarTodosProductos($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR Producto
=============================================*/
if(isset($_POST["idProducto"])){

	$editar = new AjaxProductos();
	$editar -> idProducto = $_POST["idProducto"];
	$editar -> ajaxEditarProducto();

}

/*=============================================
VER PRODUCTOS
=============================================*/
if(isset($_POST["id"])){

	$ver = new AjaxProductos();
	$ver -> id = $_POST["id"];
	$ver -> ajaxVerProducto();

}