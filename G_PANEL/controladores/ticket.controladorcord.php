<?php





class ControladorTicketsCord{

	static public function ctrCrearTicketsCord(){

		if(isset($_POST["nuevoProblema"])){

			$tabla = "tickets";

			$datos = array( "solicitado_por" => $_POST["nuevoSolicitadoPor"],
							"problema" => $_POST["nuevoProblema"],
							"prioridad" => $_POST["nuevoPrioridad"]);

			

			$respuesta = ModeloTickets::mdlIngresarTickets($tabla, $datos);

			if($respuesta == "ok"){

				echo "

					<script>

						Swal.fire({

							title: 'Exito...!!!',

							text: 'El Rol se ha registrado correctamente.',

							icon: 'success',

							confirmButtonColor: '#3085d6',

							confirmButtonText: 'Aceptar'

						}).then(function(result){

							if(result.value){

								window.location = 'tickets-user';

							}

						});

					</script>";

			} else {

				echo "

					<script>

						Swal.fire({

							title: 'Error...!!!',

							text: 'El Rol no se ha registrado.',

							icon: 'error',

							confirmButtonColor: '#3085d6',

							confirmButtonText: 'Aceptar'

						}).then(function(result){

							if(result.value){

								window.location = 'tickets-user';

							}

						});

					</script>";

			}	

		}

	}

	/*=============================================
	MOSTRAR tickets
	=============================================*/
	static public function ctrMostrarTicketsCord($item, $valor){
		$tabla = "tickets";
		$respuesta = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarTicketsTec($item, $valor){
		$tabla = "tickets";
		$respuesta = ModeloTicketsCord::MdlMostrarTicketsTec($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================

	EDITAR Tickets

	=============================================*/

	static public function ctrEditarTicketCord(){

		if(isset($_POST["editarProblema"])){


			$tabla = "tickets";

			$datos = array("problema" => $_POST["editarProblema"],

							"tipo_problema" => $_POST['editarTipoProblema'],

							"prioridad" => $_POST['editarPrioridad'],

							"solicitado_por" => $_POST['editarSolicitadoPor'],

							"asignado_a" => $_POST['editarasignado'],

							"id_sucursal" => $_POST['editarIdSucursal'],

							"tiempo" => $_POST['editarTiempoEstimado'],

							"id" => $_POST['idTickets']);

			$respuesta = ModeloTicketsCord::mdlEditarTicketCord($tabla, $datos);

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

		$respuesta = ModeloTicketsCord::MdlAñoTickets($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================

	Obtener mes de todos los registros

	=============================================*/

	static public function ctrMesTickets($item, $valor){

		$tabla = "tickets";

		$respuesta = ModeloTicketsCord::MdlMesTickets($tabla, $item, $valor);

		return $respuesta;

	}

}