<?php



if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok")
{     

    
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
        <link href="vista/css/font-face.css" rel="stylesheet" media="all">
        <link rel="shortcut icon" href="vista/images/Logos/favicon.ico">
        <link href="vista/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <!-- Bootstrap CSS-->
        <link href="vista/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href="vista/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="vista/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="vista/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vista/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <!-- Main CSS-->
        <link href="vista/css/theme.css" rel="stylesheet" media="all">
        <!-- DataTables CSS-->
        <link rel="stylesheet" href="vista/vendor/DataTables/datatables.css" media="all">
        <link rel="stylesheet" href="vista/vendor/DataTables/Bootstrap-5-5.1.3/css/bootstrap.css" media="all">
        <!-- SweetAlert CSS-->
        <link href="vista/vendor/sweetalert/sweetalert2.css" rel="stylesheet" media="all">

        <!-- Jquery JS-->
        <script src="vista/vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="vista/vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="vista/vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="vista/vendor/slick/slick.min.js">
        </script>
        <script src="vista/vendor/wow/wow.min.js"></script>
        <script src="vista/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vista/vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vista/vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vista/vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vista/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vista/vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vista/vendor/select2/select2.min.js">
        </script>
        
        <!-- DataTable JS-->
        <script src="vista/vendor/DataTables/datatables.js"></script>
        <script src="vista/vendor/DataTables/Bootstrap-5-5.1.3/js/bootstrap.bundle.js"></script>
        <script src="vista/js/script.js"></script>
        <!-- Sweetalert2 JS-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    </head>

    <body class="small">
        <div class="page-wrapper">
            <div class="loader-page hidden">
                <span class="loader"></span>
            </div>
            <?php
                /*=============================================
                    CABEZOTE - MENU
                    =============================================*/
                    include "modulos/menu.php";

                    /*=============================================
                    CONTENIDO
                    =============================================*/
                    if(isset($_GET["ruta"])){

                        if( $_GET["ruta"] == "dashboard" ||
                            $_GET["ruta"] == "usuarios" ||
                            $_GET["ruta"] == "vacancias" ||
                            $_GET["ruta"] == "roles" ||
                            $_GET["ruta"] == "clientes" ||
                            $_GET["ruta"] == "sin-acceso" ||
                            $_GET["ruta"] == "salir")
                        {

                            include "modulos/".$_GET["ruta"].".php";

                        } else {

                            include "modulos/sin-acceso.php";

                        }

                    }else{

                        include "modulos/dashboard.php";

                    }
                ?>
        </div>
        <!-- Main JS-->
        <script src="vista/js/main.js"></script>
        <script src="vista/js/usuario.js"></script>
        <script src="vista/js/rol.js"></script>
        <script src="vista/js/cliente.js"></script>
    </body>

    </html>
    <!-- end document-->

<?php  
    } else {
        include 'modulos/login.php';
    }
?>