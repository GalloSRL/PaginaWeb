<?php

class ControladorRoles{
	
	/*=============================================
	REGISTRO DE ROLES
	=============================================*/
	static public function ctrCrearRol(){
		if(isset($_POST["nuevoRol"])){
			$tabla = "rol";
			$datos = array("nombre_rol" => $_POST["nuevoRol"],
							"id_user" => $_POST["id_user"]);
			$respuesta = ModeloRoles::mdlIngresarRol($tabla, $datos);
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
								window.location = 'roles';
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
								window.location = 'roles';
							}
						});
					</script>";
			}	
		}
	}
	/*=============================================
	MOSTRAR ROLES
	=============================================*/
	static public function ctrMostrarRoles($item, $valor){
		$tabla = "rol";
		$respuesta = ModeloRoles::mdlMostrarRoles($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR ROLES
	=============================================*/
	static public function ctrEditarRoles(){
		if(isset($_POST["editarRol"])){
			$tabla = "rol";
			$datos = array(	"id" => $_POST["id_rol"],
							"nombre_rol" => $_POST["editarRol"]);
			$respuesta = ModeloRoles::mdlEditarRol($tabla, $datos);
			if($respuesta == "ok"){
				echo "
					<script>
						Swal.fire({
							title: 'Exito...!!!',
							text: 'El Rol se ha modificado correctamente.',
							icon: 'success',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Aceptar'
						}).then(function(result){
							if(result.value){
								window.location = 'roles';
							}
						});
					</script>";
			} else {
				echo "
					<script>
						Swal.fire({
							title: 'Error...!!!',
							text: 'El Rol no se ha modificado.',
							icon: 'error',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Aceptar'
						}).then(function(result){
							if(result.value){
								window.location = 'roles';
							}
						});
					</script>";
			}	
		}

	}
	/*=============================================
	BORRAR ROLES
	=============================================*/
	static public function ctrBorrarRoles(){
		if(isset($_GET["idRol"])){
			$tabla ="rol";
			$datos = $_GET["idRol"];
			$valor = 0;
			$respuesta = ModeloRoles::mdlBorrarRol($tabla, $datos, $valor); 	
			if($respuesta == "ok"){
				echo "
						<script>
							Swal.fire({
								title: 'Exito...!!!',
								text: 'El Rol se ha eliminado correctamente.',
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Aceptar'
							}).then(function(result){
								if(result.value){					
								window.location = 'roles';
								}
							});
						</script>";
			}		
		}
	}
}