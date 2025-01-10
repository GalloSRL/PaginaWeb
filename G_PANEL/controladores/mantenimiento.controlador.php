<?php

class ControladorMantenimientos{
	/*=============================================
	REGISTRO DE MANTENIMIENTOS
	=============================================*/
	static public function ctrCrearMantenimiento(){
		if(isset($_POST["nuevoSucursal"])){
			$tabla = "mantenimiento";
            $fecha = $_POST["nuevoProximaRevision"];
            $fecha_valida = str_replace("/", "-", $fecha);
            $fecha_datetime = new DateTime($fecha_valida);
            $fecha_formateada = date_format($fecha_datetime, "Y-m-d");

            $datos = array( "fecha_realizada" => $_POST["nuevoFechaRealizada"],
                            "sucursal" => $_POST["nuevoSucursal"],
                            "seccion" => $_POST["nuevoSeccion"],
                            "tipo_equipo" => $_POST["nuevoTipoEquipo"],
                            "usuario" => $_POST["nuevoUsuario"],
                            "responsable_realizacion" => $_POST["nuevoResponsableRealizacion"],
                            "nro_factura" => $_POST["nuevoNroFactura"],
                            "detalle" => $_POST["nuevoDetalle"],
                            "referencia" => $_POST["nuevoReferencia"],
                            "proxima_revision" => $fecha_formateada);
            $respuesta = ModeloMantenimientos::mdlIngresarMantenimiento($tabla, $datos);
            if($respuesta == "ok"){
                echo "
                    <script>
                        Swal.fire({
                            title: 'Exito...!!!',
                            text: 'El Mantenimiento se ha registrado correctamente.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'mantenimiento';
                            }
                        });
                    </script>";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            title: 'Error...!!!',
                            text: 'El Mantenimiento no se ha registrado.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'mantenimiento';
                            }
                        });
                    </script>";
            }
		}
	}

    /*=============================================
	REGISTRO DE MANTENIMIENTOS CON REFERENCIA
	=============================================*/
	static public function ctrCrearMantenimientoRef(){
		if(isset($_POST["nuevoRefeReferencia"])){
			$tabla = "mantenimiento";
            $fecha = $_POST["nuevoRefeProximaRevision"];
            $fecha_valida = str_replace("/", "-", $fecha);
            $fecha_datetime = new DateTime($fecha_valida);
            $fecha_formateada = date_format($fecha_datetime, "Y-m-d");
            $datos = array( "fecha_realizada" => $_POST["nuevoRefeFechaRealizada"],
                            "sucursal" => $_POST["nuevoRefeSucursal"],
                            "seccion" => $_POST["nuevoRefeSeccion"],
                            "tipo_equipo" => $_POST["nuevoRefeTipoEquipo"],
                            "usuario" => $_POST["nuevoRefeUsuario"],
                            "responsable_realizacion" => $_POST["nuevoRefeResponsableRealizacion"],
                            "nro_factura" => $_POST["nuevoRefeNroFactura"],
                            "detalle" => $_POST["nuevoRefeDetalle"],
                            "referencia" => $_POST["nuevoRefeReferencia"],
                            "proxima_revision" => $fecha_formateada);
            $respuesta = ModeloMantenimientos::mdlIngresarMantenimiento($tabla, $datos);
            if($respuesta == "ok"){
                $datos2 = array(
                    "id" => $_POST["nuevoRefeReferencia"],
                    "estado" => "Mantenimiento Realizado"
                );
                $respuesta = ModeloMantenimientos::mdlEditarMantenimientoRef($tabla, $datos2);
                if($respuesta == "ok"){
                    echo "
                    <script>
                        Swal.fire({
                            title: 'Exito...!!!',
                            text: 'El Mantenimiento se ha registrado correctamente.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'mantenimiento';
                            }
                        });
                    </script>";
                }
            } else {
                echo "
                    <script>
                        Swal.fire({
                            title: 'Error...!!!',
                            text: 'El Mantenimiento no se ha registrado.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'mantenimiento';
                            }
                        });
                    </script>";
            }
		}
	}
	/*=============================================
	MOSTRAR MANTENIMIENTOS
	=============================================*/
	static public function ctrMostrarMantenimientos($item, $valor){
		$tabla = "mantenimiento";
		$respuesta = ModeloMantenimientos::MdlMostrarMantenimientos($tabla, $item, $valor);
		return $respuesta;
	}
    /*=============================================
	BUSCAR MANTENIMIENTOS POR REFERENCIA
	=============================================*/
	static public function ctrMostrarMantenimientosRefe($item, $valor){
		$tabla = "mantenimiento";
		$respuesta = ModeloMantenimientos::MdlMostrarMantenimientos($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR MANTENIMIENTOS
	=============================================*/
	static public function ctrEditarMantenimiento(){
		if(isset($_POST["editarSucursal"])){
            $tabla = "mantenimiento";
            if ($_POST["editarIdReferencia"] != 0){
                $datos2 = array(
                    "id" => $_POST["editarIdReferencia"],
                    "estado" => "Pendiente"
                );
                $respuesta = ModeloMantenimientos::mdlEditarMantenimientoRef($tabla, $datos2);
                if($respuesta == "ok"){
                    $fecha = $_POST["editarProximaRevision"];
                    $fecha_valida = str_replace("/", "-", $fecha);
                    $fecha_datetime = new DateTime($fecha_valida);
                    $fecha_formateada = date_format($fecha_datetime, "Y-m-d");
                    $datos = array( "id" => $_POST["editarId"],
                                "fecha_realizada" => $_POST["editarFechaRealizada"],
                                "sucursal" => $_POST["editarSucursal"],
                                "seccion" => $_POST["editarSeccion"],
                                "tipo_equipo" => $_POST["editarTipoEquipo"],
                                "usuario" => $_POST["editarUsuario"],
                                "responsable_realizacion" => $_POST["editarResponsableRealizacion"],
                                "nro_factura" => $_POST["editarNroFactura"],
                                "detalle" => $_POST["editarDetalle"],
                                "referencia" => $_POST["editarReferencia"],
                                "proxima_revision" => $fecha_formateada);
                    $respuesta = ModeloMantenimientos::mdlEditarMantenimiento($tabla, $datos);
                    if($respuesta == "ok"){
                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Exito...!!!',
                                    text: 'El Mantenimiento se ha actualizado correctamente.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(function(result){
                                    if(result.value){
                                        window.location = 'mantenimiento';
                                    }
                                });
                            </script>";
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Error...!!!',
                                    text: 'El Mantenimiento no se ha actualizado.',
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(function(result){
                                    if(result.value){
                                        window.location = 'mantenimiento';
                                    }
                                });
                            </script>";
                    }
                }
            } else{
                if($_POST["editarReferencia"] != 0){
                    $datos2 = array(
                        "id" => $_POST["editarReferencia"],
                        "estado" => "Mantenimiento Realizado"
                    );
                    $respuesta = ModeloMantenimientos::mdlEditarMantenimientoRef($tabla, $datos2);
                    if($respuesta == "ok"){
                        $fecha = $_POST["editarProximaRevision"];
                        $fecha_valida = str_replace("/", "-", $fecha);
                        $fecha_datetime = new DateTime($fecha_valida);
                        $fecha_formateada = date_format($fecha_datetime, "Y-m-d");
                        $datos = array( "id" => $_POST["editarId"],
                                    "fecha_realizada" => $_POST["editarFechaRealizada"],
                                    "sucursal" => $_POST["editarSucursal"],
                                    "seccion" => $_POST["editarSeccion"],
                                    "tipo_equipo" => $_POST["editarTipoEquipo"],
                                    "usuario" => $_POST["editarUsuario"],
                                    "responsable_realizacion" => $_POST["editarResponsableRealizacion"],
                                    "nro_factura" => $_POST["editarNroFactura"],
                                    "detalle" => $_POST["editarDetalle"],
                                    "referencia" => $_POST["editarReferencia"],
                                    "proxima_revision" => $fecha_formateada);
                        $respuesta = ModeloMantenimientos::mdlEditarMantenimiento($tabla, $datos);
                        if($respuesta == "ok"){
                            echo "
                                <script>
                                    Swal.fire({
                                        title: 'Exito...!!!',
                                        text: 'El Mantenimiento se ha actualizado correctamente.',
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Aceptar'
                                    }).then(function(result){
                                        if(result.value){
                                            window.location = 'mantenimiento';
                                        }
                                    });
                                </script>";
                        } else {
                            echo "
                                <script>
                                    Swal.fire({
                                        title: 'Error...!!!',
                                        text: 'El Mantenimiento no se ha actualizado.',
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Aceptar'
                                    }).then(function(result){
                                        if(result.value){
                                            window.location = 'mantenimiento';
                                        }
                                    });
                                </script>";
                        }
                    }
                }else{
                    $fecha = $_POST["editarProximaRevision"];
                    $fecha_valida = str_replace("/", "-", $fecha);
                    $fecha_datetime = new DateTime($fecha_valida);
                    $fecha_formateada = date_format($fecha_datetime, "Y-m-d");
                    $datos = array( "id" => $_POST["editarId"],
                                    "fecha_realizada" => $_POST["editarFechaRealizada"],
                                    "sucursal" => $_POST["editarSucursal"],
                                    "seccion" => $_POST["editarSeccion"],
                                    "tipo_equipo" => $_POST["editarTipoEquipo"],
                                    "usuario" => $_POST["editarUsuario"],
                                    "responsable_realizacion" => $_POST["editarResponsableRealizacion"],
                                    "nro_factura" => $_POST["editarNroFactura"],
                                    "detalle" => $_POST["editarDetalle"],
                                    "referencia" => $_POST["editarReferencia"],
                                    "proxima_revision" => $fecha_formateada);
                    $respuesta = ModeloMantenimientos::mdlEditarMantenimiento($tabla, $datos);
                    if($respuesta == "ok"){
                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Exito...!!!',
                                    text: 'El Mantenimiento se ha actualizado correctamente.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(function(result){
                                    if(result.value){
                                        window.location = 'mantenimiento';
                                    }
                                });
                            </script>";
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Error...!!!',
                                    text: 'El Mantenimiento no se ha actualizado.',
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(function(result){
                                    if(result.value){
                                        window.location = 'mantenimiento';
                                    }
                                });
                            </script>";
                    }
                }
            }
                
		}

	}
	/*=============================================
	BORRAR MANTENIMIENTOS
	=============================================*/
	static public function ctrBorrarMantenimiento(){
		if(isset($_GET["idMantenimiento"])){
			$tabla ="mantenimiento";
			$datos = $_GET["idMantenimiento"];
			$respuesta = ModeloMantenimientos::mdlBorrarMantenimiento($tabla, $datos);
			if($respuesta == "ok"){
                
                $datos2 = array(
                    "id" => $_GET["idReferencia"],
                    "estado" => "Pendiente"
                );
                $respuesta = ModeloMantenimientos::mdlEditarMantenimientoRef($tabla, $datos2);
                if($respuesta == "ok"){
                    echo "
                            <script>
                                Swal.fire({
                                    title: 'Exito...!!!',
                                    text: 'El Mantenimiento se ha eliminado correctamente.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                }).then(function(result){
                                    if(result.value){					
                                    window.location = 'mantenimiento';
                                    }
                                });
                            </script>";
                }
			}		
		}
	}
}