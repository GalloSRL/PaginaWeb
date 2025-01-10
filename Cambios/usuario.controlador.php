<?php

session_start();

class ControladorUsuarios{
	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	static public function ctrIngresoUsuario(){
		if(isset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9 *#]+$/', $_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9 *#]+$/', $_POST["ingPassword"])){
				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "usuarios";
				$item = "usuario_user";
				$valor = $_POST["ingUsuario"];
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
				$tabla2 = "rol";
				$item2 = "id";
				$valor2 = $respuesta["id_rol"];
				
				$res = ModeloRoles::MdlMostrarRolesSesion($tabla2, $item2, $valor2); 

				if($respuesta["usuario_user"] == $_POST["ingUsuario"] && $respuesta["password_user"] == $encriptar){
					if($respuesta["estado_user"] == 1){
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre_user"] = $respuesta["nombre_user"];
						$_SESSION["usuario_user"] = $respuesta["usuario_user"];
						$_SESSION["tipo_user"] = $res['nombre_rol'];

						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/
						date_default_timezone_set('America/Asuncion');
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha.' '.$hora;
						$item1 = "ultimo_login_user";
						$valor1 = $fechaActual;
						$item2 = "id";
						$valor2 = $respuesta["id"];
						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
						if($ultimoLogin == "ok"){
							echo '<script>
								window.location = "dashboard";
							</script>';
						}
								
					} else {
						echo "
						<script>
							Swal.fire({
								text: 'El Usuario no esta activado. Favor contactese con el Dpto. de Informática.',
								icon: 'error',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'login';
								}
							});
						</script>";
					}		
				}else{
					echo "
						<script>
							Swal.fire({
								text: 'Usuario o Contraseña Incorrecta',
								icon: 'error',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'login';
								}
							});
						</script>";
				}
			}	
		}
	}
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/
	static public function ctrCrearUsuario(){
		if(isset($_POST["nuevoUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   	preg_match('/^[a-zA-Z0-9 .,"#$%&()*]+$/', $_POST["nuevoPassword"])){
				$tabla = "usuarios";
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datos = array("nombre_user" => $_POST["nuevoNombre"],
								"usuario_user" => $_POST["nuevoUsuario"],
								"password_user" => $encriptar,
								"id_rol" => $_POST["nuevoRol"],
								"email" => $_POST["nuevoEmail"],
								"id_user" => $_POST["id_user"]);
				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
				if($respuesta == "ok"){
					echo "
						<script>
							Swal.fire({
								title: 'Exito...!!!',
								text: 'El Usuario se ha registrado correctamente.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'usuarios';
								}
							});
						</script>";
				} else {
					echo "
						<script>
							Swal.fire({
								title: 'Error...!!!',
								text: 'El Usuario no se ha registrado.',
								icon: 'error',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'usuarios';
								}
							});
						</script>";
				}	
			}else{
				echo "
						<script>
							Swal.fire({
								title: 'Alerta...!!!',
								text: 'El Usuario y Contraseña no puede llevar caracteres especiales.',
								icon: 'info',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'usuarios';
								}
							});
						</script>";
			}
		}
	}
	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function ctrMostrarUsuarios($item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarUsuariosRol($item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuariosRol($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR USUARIO
	=============================================*/
	static public function ctrEditarUsuario(){
		if(isset($_POST["editarUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){
				$tabla = "usuarios";
				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9 .,"#$%&()*]+$/', $_POST["editarPassword"])){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}else{
						echo "
						<script>
							Swal.fire({
								title: 'Alerta...!!!',
								text: 'El Usuario y Contraseña no puede llevar caracteres especiales.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'usuarios';
								}
							});
						</script>";
					}
				}else{
					$encriptar = $_POST["passwordActual"];
				}
				$datos = array( "id" => $_POST["editarId"],
								"nombre_user" => $_POST["editarNombre"],
								"usuario_user" => $_POST["editarUsuario"],
								"password_user" => $encriptar,
								"id_rol" => $_POST["editarRol"],
								"email" => $_POST["editarEmail"]);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo "
						<script>
							Swal.fire({
								title: 'Exito...!!!',
								text: 'El Usuario se ha actualizado correctamente.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'usuarios';
								}
							});
						</script>";
				}
			}else{
				echo "
						<script>
							Swal.fire({
								title: 'Alerta...!!!',
								text: 'El Nombre no puede ir vacio o llevar caracteres especiales.',
								icon: 'info',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){

								if(result.value){
								
									window.location = 'usuarios';
		
								}
							});
						</script>";

			}

		}

	}
	/*=============================================
	EDITAR CONTRASEÑA
	=============================================*/
	static public function ctrEditarContraseña(){
		if(isset($_POST["editarPassword"])){

			$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "usuarios";
				$datos = array( "id" => $_POST["editarId"],
								"password_user" => $encriptar);

				$respuesta = ModeloUsuarios::mdlEditarContraseña($tabla, $datos);

				if($respuesta == "ok"){

					echo "
						<script>
							Swal.fire({
								title: 'Exito...!!!',
								text: 'Su contraseña se ha cambiado correctamente.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){
									window.location = 'salir';
								}
							});
						</script>";
				}

		}

	}
	/*=============================================
	BORRAR USUARIO
	=============================================*/
	static public function ctrBorrarUsuario(){
		if(isset($_GET["idUsuario"])){
			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];
			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
			if($respuesta == "ok"){
				echo "
						<script>
							Swal.fire({
								title: 'Exito...!!!',
								text: 'El Usuario se ha eliminado correctamente.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){					
								window.location = 'usuarios';
								}
							});
						</script>";
			}		
		}
	}
}