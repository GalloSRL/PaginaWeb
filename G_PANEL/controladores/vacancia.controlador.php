<?php

class ControladorVacancias{
	
	/*=============================================
	REGISTRO DE VACANCIAS
	=============================================*/
	static public function ctrCrearVacancia(){
		if(isset($_POST["nuevoVacancia"])){
			//Funcion para agregar codigo HTML al textarea
			function addPrefixToLines($string, $prefix) {
				// Agregar prefijo al inicio de cada línea
				$string = preg_replace('/^/m', $prefix, $string);
				return $string;
			}

			$stringPerfil = $_POST['nuevoPerfil'];
			$stringOfrece = $_POST['nuevoOfrece'];
			$stringValora = $_POST['nuevoValora'];
			$prefix = '<i class="fas fa-arrow-alt-circle-right text-danger"></i> ';
			
			$modificarstringPerfil = addPrefixToLines($stringPerfil, $prefix);
			$modificarstringOfrece = addPrefixToLines($stringOfrece, $prefix);
			$modificarstringValora = addPrefixToLines($stringValora, $prefix);

			$stringNuevoPerfil = $modificarstringPerfil;
			$stringNuevoOfrece = $modificarstringOfrece;
			$stringNuevoValora = $modificarstringValora;
			
			$exceptions = array(
				"\n"  => "<br>",
			);
			
			
			$nuevoPerfil = str_replace(array_keys($exceptions), array_values($exceptions), $stringNuevoPerfil);
			$nuevoOfrece = str_replace(array_keys($exceptions), array_values($exceptions), $stringNuevoOfrece);
			$nuevoValora = str_replace(array_keys($exceptions), array_values($exceptions), $stringNuevoValora);
			
			
			

			/*=============================================
			VALIDAR IMAGEN
			=============================================*/
			$ruta = "";
			if(isset($_FILES["nuevaFoto"]["tmp_name"])){
				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				$nuevoAncho = $ancho;
				$nuevoAlto = $alto;
				$stringNuevoVacancia = $_POST['nuevoVacancia'];
			
				$valorCambio = array(
					"/"  => "-",
				);
				$nuevoVacancia = str_replace(array_keys($valorCambio), array_values($valorCambio), $stringNuevoVacancia);
				$nuevoVac = str_replace(' ','',$nuevoVacancia);
				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/
				$directorio = "vista/images/vacancias/".trim($nuevoVac);
				mkdir($directorio, 0777, true);
				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/
				if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,1000);
					$ruta = "vista/images/vacancias/".$nuevoVac."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);
				}
				if($_FILES["nuevaFoto"]["type"] == "image/png"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,10000);
					$ruta = "vista/images/vacancias/".$nuevoVac."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}
				if($_FILES["nuevaFoto"]["type"] == "image/webp"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,10000);
					$ruta = "vista/images/vacancias/".$nuevoVac."/".$aleatorio.".webp";
					$origen = imagecreatefromwebp($_FILES["nuevaFoto"]["tmp_name"]);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagewebp($destino, $ruta);
				}
			}
			$tabla = "vacancias";
			$datos = array("vacancia" => mb_strtoupper($_POST['nuevoVacancia']),
							"perfil" => $nuevoPerfil,
							"ofrece" => $nuevoOfrece,
							"valora" => $nuevoValora,
							"lugar_vacancia" => mb_strtoupper($_POST["nuevoLugarVacancia"]),
							"fecha_inicio" => $_POST["nuevoFechaInicio"],
							"fecha_fin" => $_POST["nuevoFechaFin"],
							"flyer" => $ruta);
			$respuesta = ModeloVacancias::mdlIngresarVacancia($tabla, $datos);
			if($respuesta == "ok"){
				echo "
					<script>
						Swal.fire({
							title: 'Exito...!!!',
							text: 'La vacancia laboral se ha registrado correctamente.',
							icon: 'success',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Aceptar'
						}).then(function(result){
							if(result.value){
								window.location = 'vacancias';
							}
						});
					</script>";
			} else {
				echo "
					<script>
						Swal.fire({
							title: 'Error...!!!',
							text: 'La Vacancia no se ha registrado.',
							icon: 'error',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Aceptar'
						}).then(function(result){
							if(result.value){
								window.location = 'vacancias';
							}
						});
					</script>";
			}
		}
	}
	/*=============================================
	MOSTRAR VACANCIAS
	=============================================*/
	static public function ctrMostrarVacancias($item, $valor){
		$tabla = "vacancias";
		$respuesta = ModeloVacancias::MdlMostrarVacancias($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR CONTEO DE POSTULANTES
	=============================================*/
	static public function ctrMostrarConteoPostulantes($item, $valor){
		$tabla = "vacancias";
		$respuesta = ModeloVacancias::mdlMostrarConteoPostulantes($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	SUMA DE POSTULACIONES
	=============================================*/
	static public function ctrSumaPostulaciones($item, $valor){
		$tabla = "vacancias";
		$respuesta = ModeloVacancias::mdlMostrarSumaPostulaciones($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR VACANCIAS POR ESTADO
	=============================================*/
	static public function ctrMostrarVacanciasEstado($item, $valor){
		$tabla = "vacancias";
		$respuesta = ModeloVacancias::MdlMostrarVacanciasEstado($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR VACANCIA
	=============================================*/
	static public function ctrEditarVacancia(){
		if(isset($_POST["editarVacancia"])){
			//Funcion para agregar codigo HTML al textarea
			function addPrefixToLines($string, $prefix) {
				// Agregar prefijo al inicio de cada línea
				$string = preg_replace('/^/m', $prefix, $string);
				return $string;
			}

			$stringPerfil = $_POST['editarPerfil'];
			$stringOfrece = $_POST['editarOfrece'];
			$stringValora = $_POST['editarValora'];
			$prefix = '<i class="fas fa-arrow-alt-circle-right text-danger"></i> ';
			
			$modificarstringPerfil = addPrefixToLines($stringPerfil, $prefix);
			$modificarstringOfrece = addPrefixToLines($stringOfrece, $prefix);
			$modificarstringValora = addPrefixToLines($stringValora, $prefix);

			$stringEditarPerfil = $modificarstringPerfil;
			$stringEditarOfrece = $modificarstringOfrece;
			$stringEditarValora = $modificarstringValora;

			$exceptions = array(
				"\n"  => "<br>",
			);

			$editarPerfil = str_replace(array_keys($exceptions), array_values($exceptions), $stringEditarPerfil);
			$editarOfrece = str_replace(array_keys($exceptions), array_values($exceptions), $stringEditarOfrece);
			$editarValora = str_replace(array_keys($exceptions), array_values($exceptions), $stringEditarValora);

			


			/*=============================================
			VALIDAR IMAGEN
			=============================================*/
			$ruta = $_POST["fotoActual"];
			if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
				list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
				$nuevoAncho = $ancho;
				$nuevoAlto = $alto;
				$stringEditarVacancia = $_POST['editarVacancia'];
			
				$valorCambio = array(
					"/"  => "-",
				);
				$editarVacancia = str_replace(array_keys($valorCambio), array_values($valorCambio), $stringEditarVacancia);
				$editarVac = str_replace(' ','',$editarVacancia);
				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA VACANCIA
				=============================================*/
				$directorio = "vista/images/vacancias/".$editarVac;
				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/
				if(!empty($_POST["fotoActual"])){
					unlink($_POST["fotoActual"]);
				}else{
					mkdir($directorio, 0777, true);
				}	
				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/
				if($_FILES["editarFoto"]["type"] == "image/jpeg"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,10000);
					$ruta = "vista/images/vacancias/".$editarVac."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);
				}
				if($_FILES["editarFoto"]["type"] == "image/png"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,10000);
					$ruta = "vista/images/vacancias/".$editarVac."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}
				if($_FILES["editarFoto"]["type"] == "image/webp"){
					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$aleatorio = mt_rand(1,10000);
					$ruta = "vista/images/vacancias/".$editarVac."/".$aleatorio.".webp";
					$origen = imagecreatefromwebp($_FILES["editarFoto"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagewebp($destino, $ruta);
				}
			}
			$tabla = "vacancias";

			$datos = array("id" => $_POST["editarId"],
							"vacancia" => mb_strtoupper($_POST['editarVacancia']),
							"perfil" => $editarPerfil,
							"ofrece" => $editarOfrece,
							"valora" => $editarValora,
							"lugar_vacancia" => mb_strtoupper($_POST["editarLugarVacancia"]),
							"fecha_inicio" => $_POST["editarFechaInicio"],
							"fecha_fin" => $_POST["editarFechaFin"],
							"flyer" => $ruta);
			$respuesta = ModeloVacancias::mdlEditarVacancia($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				Swal.fire({
						icon: "success",
						title: "La vacancia ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {
								window.location = "vacancias";
								}
							})
				</script>';
			}
		}
	}
	/*=============================================
	BORRAR VACANCIA
	=============================================*/
	static public function ctrBorrarVacancia(){
		if(isset($_GET["idVacancia"])){
			$tabla ="vacancias";
			$datos = $_GET["idVacancia"];
			if($_GET["fotoVacancia"] != ""){
				unlink($_GET["fotoVacancia"]);
				rmdir('vista/images/vacancias/'.$_GET["vacancia"]);
			}
			$respuesta = ModeloVacancias::mdlBorrarVacancia($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				Swal.fire({
					icon: "success",
					title: "La vacancia sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							window.location = "vacancias";
						}
					})
				</script>';
			}		
		}
	}
}