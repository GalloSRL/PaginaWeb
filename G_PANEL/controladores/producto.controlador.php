<?php



class ControladorProductos{

	

	/*=============================================

	REGISTRO DE PRODUCTOS

	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevoProducto"])){

			/*=============================================

			VALIDAR IMAGEN

			=============================================*/

			$ruta = "";

			if(isset($_FILES["nuevaFoto"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

				$nuevoAncho = $ancho;

				$nuevoAlto = $alto;

				$nombreProducto = str_replace(' ','',$_POST["nuevoProducto"]);



				/*=============================================

				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

				=============================================*/

				$directorio = "vista/images/productos/".$nombreProducto;



				mkdir($directorio, 0777, true);

				/*=============================================

				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

				=============================================*/

				if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

					/*=============================================

					GUARDAMOS LA IMAGEN EN EL DIRECTORIO

					=============================================*/

					$aleatorio = mt_rand(1,10000);

					$ruta = "vista/images/productos/".$nombreProducto."/".$nombreProducto.".jpg";

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

					$ruta = "vista/images/productos/".$nombreProducto."/".$nombreProducto.".png";

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

					$ruta = "vista/images/productos/".$nombreProducto."/".$nombreProducto.".webp";

					$origen = imagecreatefromwebp($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagewebp($destino, $ruta);

				}

			}

			$exceptions = array(

				"\n"  => "<br>",

			);

			$nuevoProductoDescripcion = str_replace(array_keys($exceptions), array_values($exceptions), $_POST['nuevoProductoDescripcion']);



			$tabla = "productos";

			$datos = array("nombre_producto" => mb_strtoupper($_POST["nuevoProducto"]),

							"descripcion_producto" => $nuevoProductoDescripcion,

							"imagen_producto" => $ruta,

							"id_user" => $_POST["nuevoIdUser"]);

			$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo "

					<script>

						Swal.fire({

							title: 'Exito...!!!',

							text: 'El Producto se ha registrado correctamente.',

							icon: 'success',

							confirmButtonColor: '#3085d6',

							confirmButtonText: 'Aceptar'

						}).then(function(result){

							if(result.value){

								window.location = 'productos';

							}

						});

					</script>";

			} else {

				echo "

					<script>

						Swal.fire({

							title: 'Error...!!!',

							text: 'El Producto no se ha registrado.',

							icon: 'error',

							confirmButtonColor: '#3085d6',

							confirmButtonText: 'Aceptar'

						}).then(function(result){

							if(result.value){

								window.location = 'productos';

							}

						});

					</script>";

			}

		}

	}

	/*=============================================

	MOSTRAR Productos

	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::MdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;

	}



	/*=============================================

	MOSTRAR Todos lo Productos

	=============================================*/

	static public function ctrMostrarTodosProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::MdlMostrarTodosProductos($tabla, $item, $valor);

		return $respuesta;

	}



	/*=============================================

	EDITAR Producto

	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarProducto"])){

			

			/*=============================================

			VALIDAR IMAGEN

			=============================================*/

			$ruta = $_POST["fotoActual"];

			if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

				$nuevoAncho = $ancho;

				$nuevoAlto = $alto;

				$editarNombre = str_replace(' ','', $_POST["editarProducto"]);

				/*=============================================

				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO

				=============================================*/

				$directorio = "vista/images/productos/".$editarNombre;

				/*=============================================

				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD

				=============================================*/

				

				if(empty($_POST["fotoActual"])){

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

					$ruta = "vista/images/productos/".$editarNombre."/".$editarNombre.".jpg";

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

					$ruta = "vista/images/productos/".$editarNombre."/".$editarNombre.".png";

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

					$ruta = "vista/images/productos/".$editarNombre."/".$editarNombre.".webp";

					$origen = imagecreatefromwebp($_FILES["editarFoto"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagewebp($destino, $ruta);

				}

			}

			$exceptions = array(

				"\n"  => "<br>",

			);

			$editarProductoDescripcion = str_replace(array_keys($exceptions), array_values($exceptions), $_POST['editarProductoDescripcion']);



			$tabla = "productos";

			$datos = array("id" => $_POST["editarId"],

							"nombre_producto" => mb_strtoupper($_POST["editarProducto"]),

							"descripcion_producto" => $editarProductoDescripcion,

							"imagen_producto" => $ruta);

			$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({

						icon: "success",

						title: "El Producto ha sido editado correctamente",

						showConfirmButton: true,

						confirmButtonText: "Cerrar"

						}).then(function(result){

								if (result.value) {

								window.location = "productos";

								}

							})

				</script>';

			}

		}

	}

	/*=============================================

	BORRAR Producto

	=============================================*/

	static public function ctrBorrarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";

			$datos = $_GET["idProducto"];

			if($_GET["fotoProducto"] != ""){

				unlink($_GET["fotoProducto"]);

				$carpetaProducto = str_replace(' ','',$_GET['producto']);

				rmdir('vista/images/productos/'.$carpetaProducto);

			}

			$respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);



			if($respuesta == "ok"){

				echo "<script>

				Swal.fire({

					icon: 'success',

					title: 'El Producto ha sido borrado correctamente',

					showConfirmButton: true,

					confirmButtonText: 'Cerrar'

					}).then(function(result){

						if (result.value) {

							window.location = 'productos';

						}

					})

				</script>";

			}		

		}

	}

}