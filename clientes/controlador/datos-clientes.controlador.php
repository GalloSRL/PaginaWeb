<?php

class ControladorDatosClientes{
	
	/*=============================================
	REGISTRO y ACTUALIZACION DE CLIENTES
	=============================================*/
	static public function ctrCrearCliente(){

		if (!empty($_POST)) {

			$captcha = $_POST['g-recaptcha-response'];

			$secret = '6LcQilwmAAAAAO7ijaFZuTtUktTThshTMqz-XN5E';

			if (!$captcha) {
				echo "
					<div class='alert alert-warning m-3' role='alert'>
						Favor Validar el captCha
					</div>
					<script>
						document.addEventListener('DOMContentLoaded', function(){
							let formulario = document.getElementById('formul');
							formulario.addEventListener('submit', function() {
							formulario.reset();
							});
						});
					</script>";
			} else {
				$response = file_get_contents(
					"https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

					$arr = json_decode($response, true);
					if ($arr['success']) {
						if($_POST["idCliente"] != ""){
							
							$tabla = "clientes";
							$datos = array("u_tipcont" => $_POST["nuevoTipoContri"],
											"u_crid" => $_POST['nuevoTipoIdent'],
											"lictradnum" => $_POST['nuevoRuc'],
											"cardname" => mb_strtoupper($_POST["nuevoRazonSocial"],'utf-8'),
											"u_crsi" => $_POST['nuevoSituacion'],
											"e_mail" => mb_strtolower($_POST['nuevoEmail'],'utf-8'),
											"phone" => $_POST['nuevoTelefono'],
											"address" => $_POST['nuevoIdDireccion'],
											"Street" =>  mb_strtoupper($_POST['nuevoCalle'],'utf-8'),
											"AdresType" => $_POST['nuevoTipoDireccion'],
											"StreetNo" => $_POST['nuevoNroCasa'],
											"U_EXX_FE_DEPT" => $_POST['nuevoDepartamento'],
											"U_EXX_FE_DIST" => $_POST['nuevoDistrito'],
											"U_EXX_FE_BALO" => $_POST['nuevoBarrio'],
											"id" => $_POST['idCliente']);
							$respuesta = ModeloDatosClientes::mdlEditarCliente($tabla, $datos);
							if($respuesta == "ok"){
								echo '<script>
									$("#loader").removeClass("loader-page");
										Swal.fire({
											title: "Exito...!!!",
											text: "Sus Datos se han actualizado correctamente.",
											icon: "success",
											confirmButtonColor: "#3085d6",
											confirmButtonText: "Aceptar"
										}).then(function(result){
											if(result.value){
												window.location = "clientes";
											}
										});
											$(".btnActualizar").addClass("hidden");
											$(".btnGuardar").removeClass("hidden");
										</script>';
							} else {
								echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
										Error en la Actualización. Favor vuelva a intentarlo
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									</div>";
							}
						}else if($_POST["nuevoTipoContri"] != ""){
							
							$tabla = "clientes";
							$datos = array("u_tipcont" => $_POST["nuevoTipoContri"],
											"u_crid" => $_POST['nuevoTipoIdent'],
											"lictradnum" => $_POST['nuevoRuc'],
											"cardname" => mb_strtoupper($_POST["nuevoRazonSocial"],'utf-8'),
											"u_crsi" => $_POST['nuevoSituacion'],
											"e_mail" => mb_strtolower($_POST['nuevoEmail'],'utf-8'),
											"phone" => $_POST['nuevoTelefono'],
											"address" => $_POST['nuevoIdDireccion'],
											"Street" =>  mb_strtoupper($_POST['nuevoCalle'],'utf-8'),
											"AdresType" => $_POST['nuevoTipoDireccion'],
											"StreetNo" => $_POST['nuevoNroCasa'],
											"U_EXX_FE_DEPT" => $_POST['nuevoDepartamento'],
											"U_EXX_FE_DIST" => $_POST['nuevoDistrito'],
											"U_EXX_FE_BALO" => $_POST['nuevoBarrio']);
							$respuesta = ModeloDatosClientes::mdlIngresarCliente($tabla, $datos);
							if($respuesta == "ok"){
								echo '<script>
										$("#loader").removeClass("loader-page");
										Swal.fire({
											title: "Exito...!!!",
											text: "Sus Datos se han registrado correctamente.",
											icon: "success",
											confirmButtonColor: "#3085d6",
											confirmButtonText: "Aceptar"
										}).then(function(result){
											if(result.value){
												window.location = "clientes";
											}
										});
										</script>';
							} else {
								echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
										Error al registrarse. Favor vuelva a intentarlo
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									</div>";
							}
						}
					}
			}
		
		}
	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloDatosClientes::MdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR DEPARTAMENTO
	=============================================*/

	static public function ctrMostrarDepartamento($item, $valor){

		$tabla = "departamento";

		$respuesta = ModeloDatosClientes::MdlMostrarDepartamento($tabla, $item, $valor);

		return $respuesta;
	}
	/*=============================================
	MOSTRAR Distrito
	=============================================*/

	static public function ctrMostrarDistrito($item, $valor){

		$tabla = "distrito";

		$respuesta = ModeloDatosClientes::MdlMostrarDistrito($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR Barrio
	=============================================*/

	static public function ctrMostrarBarrio($item, $valor){

		$tabla = "barrio";

		$respuesta = ModeloDatosClientes::MdlMostrarBarrio($tabla, $item, $valor);

		return $respuesta;
	}

}