<?php


class ControladorTickets{
	/*=============================================
	MOSTRAR tickets
	=============================================*/
	static public function ctrMostrarTickets($item, $valor){
		$tabla = "tickets";
		$respuesta = ModeloTickets::MdlMostrarTickets($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR Tickets
	=============================================*/
	static public function ctrEditarTicket(){
		if(isset($_POST["editarProblema"])){
		
			$tabla = "tickets";
			$datos = array("problema" => $_POST["editarProblema"],
							"tipo_problema" => $_POST['editarTipoProblema'],
							"prioridad" => $_POST['editarPrioridad'],
							"solicitado_por" => $_POST['editarSolicitadoPor'],
							"asignado_a" => $_POST['editarasignado'],
							"id_sucursal" => $_POST['editarIdSucursal'],
							"id" => $_POST['idTickets']);
			$respuesta = ModeloTickets::mdlEditarTicket($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				Swal.fire({
						icon: "success",
						title: "El ticket ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {
								window.location = "tickets";
								}
							})
				</script>';
			}
		}
	}
	/*=============================================
	Obtener años de todos los registros
	=============================================*/
	static public function ctrAñoTickets($item, $valor){
		$tabla = "tickets";
		$respuesta = ModeloTickets::MdlAñoTickets($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	Obtener mes de todos los registros
	=============================================*/
	static public function ctrMesTickets($item, $valor){
		$tabla = "tickets";
		$respuesta = ModeloTickets::MdlMesTickets($tabla, $item, $valor);
		return $respuesta;
	}
}