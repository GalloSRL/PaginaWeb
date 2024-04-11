<?php
    
    date_default_timezone_set('America/Asuncion');
    
    $item = null;
    $valor = null;
    $sumPostulaciones = ControladorVacancias::ctrSumaPostulaciones($item, $valor);

    $item = 'estado';
    $valor = 1;
    $vacanciasActivas = ControladorVacancias::ctrMostrarVacancias($item, $valor);

    $item = null;
    $valor = null;
    $vacancias = ControladorVacancias::ctrMostrarVacancias($item, $valor);
    $totalVacancias = count($vacancias);

    $item = null;
    $valor = null;
    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
    $totalClientes = count($clientes);

    $rutaArchivo = "../G_PANEL/vista/modulos/contador_visitas.json";
    // Leer el contenido del archivo JSON
    if (file_exists($rutaArchivo)) {
        $contador_data = json_decode(file_get_contents($rutaArchivo), true);
    } else {
        $contador_data = array();
    }
    $fecha_actual = date("Y-m-d");

    // Verificar si ya existe una entrada para la fecha actual
        if (!isset($contador_data[$fecha_actual])) {
            // Si no existe una entrada para la fecha actual, el contador es 0
            $contador_fecha_actual = 0;
        } else {
            // Si ya existe una entrada para la fecha actual, obtener el contador
            $contador_fecha_actual = $contador_data[$fecha_actual];
        }
    $total_general = array_sum($contador_data);

?>

<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <?php
                if($_SESSION['tipo_user'] == 'Administrador' || $_SESSION['tipo_user'] == 'Desarrollo Humano') {
                    
            ?>
                <div class="col-12">
                    <div class="mb-4">
                        <h2><i class="fas fa-tachometer-alt"></i> Dashboard - DHO</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="overview-item overview-item--c1 pb-4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="row">
                                            <div class="icon text-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mt-3 text-white text-bold">
                                                <?php
                                                    if($sumPostulaciones[0] == 0){
                                                        echo 0;
                                                    }else {
                                                        echo $sumPostulaciones[0];
                                                    }
                                                ?>
                                            </h1><br>
                                            <h3 class="text-bold text-white">Postulantes</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="overview-item overview-item--c2 pb-4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="row">
                                            <div class="icon text-center">
                                                <i class="fas fa-paper-plane"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mt-3 text-white text-bold">
                                                <?php
                                                    echo $vacanciasActivas[0];
                                                ?>
                                            </h1><br>
                                            <h3 class="text-bold text-white">Postulaciones Activas</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="overview-item overview-item--c3 pb-4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="row">
                                            <div class="icon text-center">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mt-3 text-white text-bold">
                                                <?php
                                                    echo $totalVacancias;
                                                ?>
                                            </h1><br>
                                            <h3 class="text-bold text-white">Vacancias Laborales</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

            <?php
                if($_SESSION['tipo_user'] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing') {
                    
            ?>
                <div class="col-12">
                    <div class="mb-4">
                        <h2><i class="fas fa-tachometer-alt"></i> Dashboard - MRKTG</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="overview-item overview-item--c2 pb-4" style="height:320px!important;">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="row">
                                            <div class="icon text-center">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="text-white text-bold">
                                                <?php
                                                    echo $total_general;
                                                ?>
                                            </h1><br>
                                            <h3 class="text-bold text-white">Visitantes de la Página</h3><br>
                                            <?php
                                                if($_SESSION['tipo_user'] == 'Administrador') {
                                                    echo '<h6 class="text-bold text-white">Visitantes de la fecha '.$fecha_actual.': '.$contador_fecha_actual.'</h6>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="overview-item overview-item--c4 pb-4" style="height:320px!important;">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="row">
                                            <div class="icon text-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="text-white text-bold">
                                                <?php
                                                    echo $totalClientes;
                                                ?>
                                            </h1><br>
                                            <h3 class="text-bold text-white">Total de Clientes Registrados</h3><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © Desarrollado por <span class="desarrollado"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTAINER-->