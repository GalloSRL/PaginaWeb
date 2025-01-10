<?php 

    ob_start();
    $imagen1 = 'https://quickchart.io/chart?c='.$_POST['imagen1'];
    $imagen2 = 'https://quickchart.io/chart?c='.$_POST['imagen2'];
    $imagen3 = 'https://quickchart.io/chart?c='.$_POST['imagen3'];
    $total = $_POST['total'];
    $year = $_POST['year'];
    $months = $_POST['mes'];
    if ($months == 1){
        $mes = 'Enero';
    } else if ($months == 2){
        $mes = 'Febrero';
    } else if ($months == 3){
        $mes = 'Marzo';
    } else if ($months == 4){
        $mes = 'Abril';
    } else if ($months == 5){
        $mes = 'Mayo';
    } else if ($months == 6){
        $mes = 'Junio';
    } else if ($months == 7){
        $mes = 'Julio';
    } else if ($months == 8){
        $mes = 'Agosto';
    } else if ($months == 9){
        $mes = 'Septiembre';
    } else if ($months == 10){
        $mes = 'Octubre';
    } else if ($months == 11){
        $mes = 'Noviembre';
    } else if ($months == 12){
        $mes = 'Diciembre';
    } else {
        $mes = 'Todos los Meses';
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">
        <!-- Title Page-->
        <title>Gallo SRL - PANEL</title>
        <!-- Fontfaces CSS-->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/css/font-face.css" rel="stylesheet" media="all">
        <link rel="shortcut icon" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/images/Logos/favicon.ico">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <!-- Bootstrap CSS-->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
        <!-- Vendor CSS-->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <!-- Main CSS-->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/css/theme.css" rel="stylesheet" media="all">
        <!-- DataTables CSS-->
        <link rel="stylesheet" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/DataTables/datatables.css" media="all">
        <link rel="stylesheet" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/DataTables/Bootstrap-5-5.1.3/css/bootstrap.css" media="all">
        <!-- SweetAlert CSS-->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/sweetalert/sweetalert2.css" rel="stylesheet" media="all">
        <!-- Jquery JS-->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/slick/slick.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/wow/wow.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/circle-progress/circle-progress.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/select2/select2.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <!-- DataTable JS-->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/DataTables/datatables.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/vendor/DataTables/Bootstrap-5-5.1.3/js/bootstrap.bundle.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/js/script.js"></script>
        <!-- Sweetalert2 JS-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quickchart-js@3.1.2/build/quickchart.min.js"></script>
        <!-- Main JS-->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/js/main.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/js/chart.js"></script>
        <style>
            @page {
                margin-left: 20px!important;
                margin-right: 8px!important;
                margin-bottom: 1px!important;
            }
        </style>
    </head>
<body>
<center>
    <div class="cabecera mb-3">
        <img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/images/icon/cabecera.png" alt="" width="90%" style="height: 80px!important;">
    </div>
</center>
<div class="container">
    <div id="contenidoReporte" class="row"> 
        <h3 class="text-center text-bold mb-4">
            Informe de Trabajos Realizados - <?php echo $mes;?> - <?php echo $year;?>.
        </h3>
        <div class="row">
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="60%" >
                            <div class="card m-2">
                                <div class="card-body">
                                    <h5 class="title-2 mb-4 text-bold text-center">Estado Tickets</h5>
                                    <div class="box-flotante" style="background: orange">
                                        <div class="row text-center p-3">
                                            <h6 class="text-bold">Total de Tickets</h6>
                                            <h2 id="totalTickets" class="text-bold"><?php echo $total; ?></h2>
                                        </div>
                                    </div>
                                    <img src='<?php echo $imagen1; ?>' alt="">
                                </div>
                            </div>
                        </td>
                        <td width="60%" >
                            <div class="card m-2">
                                <div class="card-body">
                                <h5 class="title-2 mb-4 text-bold text-center">Tickets por Persona Asignada</h5>
                                <img src='<?php echo $imagen2; ?>' alt="">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td  width="100%" style="padding: 10px;" colspan="2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="title-2 mb-4 text-bold text-center">Tickets por Tipo de Problemas</h5>
                                    <img src='<?php echo $imagen3; ?>' style="width: 100%; height: 200px!important;" alt="">
                                </div>
                            </div>
                            <img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/G_PANEL/vista/images/icon/pie de pagina.png" alt="" width="100%" style="height: 40px!important;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<!-- end document-->
<?php 
    $html = ob_get_clean();
    file_put_contents('temp_file.html', $html);
    //echo $html;
    // Redirigir al script de generación del PDF
    header("Location: renderReporte.php");
    exit;
?>