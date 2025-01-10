<?php



require_once "../controladores/usuario.controlador.php";

require_once "../modelos/usuario.modelo.php";
 


class AjaxUsuarios{



	/*=============================================

	EDITAR USUARIO

	=============================================*/	



	public $idUsuario;



	public function ajaxEditarUsuario(){



		$item = "id";

		$valor = $this->idUsuario;



		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);



		echo json_encode($respuesta);



	}


	/*=============================================

	BUSCAR USUARIO PARA TICKETS

	=============================================*/	



	public $Usuario;



	public function ajaxBuscarUsuario(){



		$item = "nombre_user";

		$valor = $this->Usuario;



		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);



		echo json_encode($respuesta);



	}


	



	/*=============================================

	ACTIVAR USUARIO

	=============================================*/	



	public $activarUsuario;

	public $activarId;





	public function ajaxActivarUsuario(){



		$tabla = "usuarios";



		$item1 = "estado_user";

		$valor1 = $this->activarUsuario;



		$item2 = "id";

		$valor2 = $this->activarId;



		$respuesta = ModeloUSuarios::mdlActualizarUSuario($tabla, $item1, $valor1, $item2, $valor2);



		echo json_encode($respuesta);

	}

	/*=============================================

	VER USUARIO

	=============================================*/	
	public $item;
	public $valor;
	public function ajaxViewUsuario(){
		$tabla = "usuarios";
		$item =  $this->item;
		$valor = $this->valor;
		$respuesta = ModeloUsuarios::mdlViewUsuarios($tabla, $item, $valor);
		echo json_encode($respuesta);

	}

}



/*=============================================

EDITAR USUARIO

=============================================*/

if(isset($_POST["idUsuario"])){



	$editar = new AjaxUsuarios();

	$editar -> idUsuario = $_POST["idUsuario"];

	$editar -> ajaxEditarUsuario();



}


/*=============================================

OBTENER USUARIO PARA TICKETS

=============================================*/

if(isset($_POST["Usuario"])){



	$buscar = new AjaxUsuarios();

	$buscar -> Usuario = $_POST["Usuario"];

	$buscar -> ajaxBuscarUsuario();



}



/*=============================================

ACTIVAR USUARIO

=============================================*/	



if(isset($_POST["activarUsuario"])){



	$activarUsuario = new AjaxUsuarios();

	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];

	$activarUsuario -> activarId = $_POST["activarId"];

	$activarUsuario -> ajaxActivarUsuario();



}


if(isset($_POST["item"])){
	$user = new AjaxUsuarios();
	$user -> item = $_POST["item"];
	$user -> valor = $_POST["valor"];
	$user -> ajaxViewUsuario();	
}

