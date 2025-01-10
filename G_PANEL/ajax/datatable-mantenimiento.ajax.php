<?php



require_once "../controladores/mantenimiento.controlador.php";

require_once "../modelos/mantenimiento.modelo.php";



class TablaMantenimientos{



    /*=============================================

    MOSTRAR LA TABLA DE MANTENIMIENTOS

    =============================================*/ 



	public function mostrarTablaMantenimientos(){

		$item = null;

        $valor = null;

        $mantenimientos = ControladorMantenimientos::ctrMostrarMantenimientos($item, $valor);	

        if(count($mantenimientos) == 0){

            echo '{"data": []}';

            return;

        }



        

		

        $datosJson = '{

            "data": [';

                for($i = 0; $i < count($mantenimientos); $i++){



                    if($mantenimientos[$i]["estado"] == "Pendiente"){

                        // Fecha de vencimiento en formato "Y-m-d"

                        $fechaVencimiento = $mantenimientos[$i]["proxima_revision"];



                        // Obtener la fecha actual en formato "Y-m-d"

                        $fechaActual = date("Y-m-d");



                        // Calcular la diferencia en días

                        $diferenciaDias = (strtotime($fechaVencimiento) - strtotime($fechaActual)) / (60 * 60 * 24);

                    



                        // Obtenemos las dos fechas.

                        $fecha_1 = new DateTime($mantenimientos[$i]["proxima_revision"]);     

                        $fecha_formateada = date_format($fecha_1, "d-m-Y");



                        

                        if ($diferenciaDias > 10) {

                            $proxima_revision = "<span class='badge badge-success'>".$fecha_formateada."</span>";

                        }



                        // Si el número de días es menor o igual a 90 y mayor que 30, entonces la badgea es "warning".

                        else if ($diferenciaDias < 10 && $diferenciaDias >= 5) {

                            $proxima_revision = "<span class='badge badge-warning'>".$fecha_formateada."</span>";

                        }



                        // Si el número de días es menor o igual a 30 y mayor que 0, entonces la proxima_revision es "danger".

                        else if ($diferenciaDias < 5) {

                            $proxima_revision = "<span class='badge badge-danger'>".$fecha_formateada."</span>";

                        }

                    } else {

                        $fecha = new DateTime($mantenimientos[$i]["proxima_revision"]);     

                        $fecha_formateada = date_format($fecha, "d-m-Y");

                        $proxima_revision = "<span class='badge badge-success'>".$fecha_formateada."</span>";

                    }

                    

                    if($mantenimientos[$i]["estado"] == "Pendiente"){

                        $estado = "<span class='badge badge-warning'>".$mantenimientos[$i]["estado"]."</span>";

                    }else{

                        $estado = "<span class='badge badge-primary'>".$mantenimientos[$i]["estado"]."</span>";

                    }

                    

                    /*=============================================

                    TRAEMOS LAS ACCIONES

                    =============================================*/ 

                    $botones =  "<span class='btn rounded-circle btn-primary btn-sm btnNuevoMantenimiento' idMantenimiento='".$mantenimientos[$i]["id"]."' data-toggle='modal' data-target='#NuevoReferenciaMantenimiento' title='Nuevo Registro Referenciado'><i class='fas fa-plus'></i></span><span class='btn rounded-circle btn-info btn-sm btnVerMantenimiento' idMantenimiento='".$mantenimientos[$i]["id"]."' data-toggle='modal' data-target='#Visualizar' title='Ver Informacion del Registro'><i class='fas fa-eye'></i></span><span class='btn rounded-circle btn-warning btn-sm btnEditarMantenimiento' idMantenimiento='".$mantenimientos[$i]["id"]."' data-toggle='modal' data-target='#Actualizacion' title='Modificar Registro'><i class='fas fa-pencil-alt'></i></span><span class='btn rounded-circle btn-danger btn-sm btnEliminarMantenimiento' idMantenimiento='".$mantenimientos[$i]["id"]."' idReferencia='".$mantenimientos[$i]["referencia"]."' title='Eliminar Registro'><i class='fas fa-trash'></i></span>"; 

                    $datosJson .='[

                        "'.$mantenimientos[$i]["id"].'",

                        "'.$mantenimientos[$i]["fecha_realizada"].'",

                        "'.$mantenimientos[$i]["sucursal"].'",

                        "'.$mantenimientos[$i]["seccion"].'",

                        "'.$mantenimientos[$i]["tipo_equipo"].'",

                        "'.$mantenimientos[$i]["usuario"].'",

                        "'.$proxima_revision.'",

                        "'.$mantenimientos[$i]["referencia"].'",

                        "'.$estado.'",

                        "'.$botones.'"

                    ],';

                }

                $datosJson = substr($datosJson, 0, -1);

            $datosJson .=   '] 

        }';

		echo $datosJson;

	}





}



/*=============================================

ACTIVAR TABLA DE MANTENIMIENTOS

=============================================*/ 

$activarMantenimientos = new TablaMantenimientos();

$activarMantenimientos -> mostrarTablaMantenimientos();



