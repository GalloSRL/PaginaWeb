<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>Gallo SRL</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> 
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="slick/slick-theme.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            async function getIpClient() {
                try {
                    const response = await axios.get('https://api.ipify.org?format=json');
                    let ip = response.data['ip'];
                    if (ip == '138.186.60.117'){
                        $('#intranet').css('display','block');
                    } else{
                        $('#intranet').css('display','none');
                    }
                } catch (error) {
                    console.error(error);
                }
            }
        </script>
        <script>
            getIpClient();
        </script>

    </head>
    <body id="page-top" onload="funcion();">
        <div id="TrabajaConNosotros">
            <div class="slider-frame">
                <!-- Navigation-->
                <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
                    <div class="container">
                        <a class="navbar-brand" href="#page-top"><img id="logo" src="assets/img/navbar-logo.png" alt="..." class="animate__animated animate__heartBeat"/></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            Menu
                            <i class="fas fa-bars ms-1"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                                <li class="nav-item"><a class="nav-link" href="index.php#inicio">Inicio</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php#nosotros">Nosotros</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php#productos">Productos</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php#preguntas">Preguntas Frecuentes</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php#contacto">Contacto</a></li>
                                <li id="trabajaNosotros" class="nav-item"><a class="nav-link active" href="TrabajaConNosotros.php">Trabaja con Nosotros</a></li>
                                <li id="intranet" class="nav-item"><a class="nav-link" href="https://gallosrl.com.py/G_PANEL/">Intranet</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <section class="page-section">
                    <div class="container">
                        <div class="text-center pb-0">
                            <h3 class="section-heading text-uppercase">CONOCÉ NUESTRAS <span class="text-gallo">VACANCIAS</span></h3>
                            <h4 class="section-subheading text-muted">Convocatorias abiertas para trabajar en Gallo SRL.</h4>
                        </div>
                        <div class="responsive">
                            <table id="tabla-trabajo" class="table table-condensed table-responsive table-hover" width="100%">
                                <thead>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once "G_PANEL/controladores/vacancia.controlador.php";
                                        require_once "G_PANEL/modelos/vacancia.modelo.php"; 

                                        $item = 'estado';
                                        $valor = 1;
                                        $vacancias = ControladorVacancias::ctrMostrarVacanciasEstado($item, $valor);
                                        foreach ($vacancias as $key => $value)
                                        {
                                    
                                        echo '<tr class="elevation-1">
                                            <td class="align-middle">
                                                <div class="row">
                                                    <div class="col-md-2 m-auto text-center mb-2">
                                                        <img class="img-200 border-radius img-fluid" src="G_PANEL/'.$value['flyer'].'" alt="'.$value['vacancia'].'">
                                                    </div>
                                                    <div class="col-md-10 m-auto text-center">
                                                        <span class="h4">'.$value['vacancia'].' - '.$value['lugar_vacancia'].'</span><br>
                                                        <strong>Vigencia: '.date('d-m-Y',strtotime($value['fecha_inicio'])).' al '.date('d-m-Y',strtotime($value['fecha_fin'])).'</strong><br>
                                                        <button class="btn btn-gallo btnVerVacancia mt-3" idVacancia="'.$value['id'].'" data-bs-toggle="modal" data-bs-target="#Visualizar"><i class="fas fa-plus"></i> Informaciones</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </section>   
            </div>
        </div>

        <!-- Visualizar Registro Final-->
        <div class="modal fade" id="Visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                <div class="modal-content" style="border-top: 3px solid #DE6262;">
                    <div class="modal-header bg-danger">
                        <h3 class="modal-title text-white font-weight-bold" id="exampleModalLabel">GALLO SRL - Vacancia Laboral</h3>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="text-start">
                                    <h3 id="vacancia" class="h1-Roboto"></h3>
                                    <input type="hidden" id="idVacancia">
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="parte1">
                                                <h5 style="text-decoration: underline; font-weight: 700;">Perfil</h5>
                                                <div class="mb-4" style="font-style: justify; padding-left: 15px;">
                                                    <p id="perfil" style="font-size: 15px"></p>
                                                </div>
                                            </div>
                                            <div class="parte2">
                                                <h5 style="text-decoration: underline; font-weight: 700;">Se Valora</h5>
                                                <div class="mb-4" style="font-style: justify; padding-left: 15px;">
                                                    <p id="valora" style="font-size: 15px"></p>
                                                </div>
                                            </div>
                                            <div class="parte3">
                                                <h5 style="text-decoration: underline; font-weight: 700;">Se Ofrece</h5>
                                                <div class="mb-2" style="font-style: justify; padding-left: 15px;">
                                                    <p id="ofrece" style="font-size: 15px"></p>
                                                </div>
                                            </div>
                                            <div class="parte4">
                                                <div class="mb-2" style="font-style: justify; padding-left: 15px;">
                                                    <p id="vigencia" class="text-muted" style="font-size: 15px"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-info btnPostularse" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#Postulacion"><i class="fas fa-clipboard-list"></i> Postulate Aqui</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="container">
                                        <img id="foto" alt="Foto Vacancia" class="img-100x100 elevation-3 border-radius">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Postulacion-->
        <div class="modal fade" id="Postulacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-top: 3px solid #DE6262;">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Registro de Postulación</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  enctype="multipart/form-data" id="formulario-postulacion" method="POST">
                            <input type="hidden" name="id" id="id_vacancia">
                            <input type="hidden" name="vacancia" id="nombre_vacancia">
                            <input type="hidden" name="conteoPostulacion" id="conteo_vacancia">
                            <div class="row">
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">Nombre Completo:</label>
                                    <input type="text" class="form-control" id="post_nombre" name="post_nombre" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">Numero de Cédula:</label>
                                    <input type="text" class="form-control" id="post_ci" name="post_ci" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">Telefono:</label>
                                    <input type="text" class="form-control" id="post_telefono" name="post_telefono" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">E-Mail:</label>
                                    <input type="email" class="form-control" id="post_email" name="post_email" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">Mensaje:</label>
                                    <textarea type="text" class="form-control" rows="3" id="post_mensaje" name="post_mensaje"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-bold" for="">Inserte su CV:</label>
                                    <input type="file" class="form-control" name="post_archivo" id="post_archivo" required>
                                </div>
                                <div class="text-center mt-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 float-end mb-3">
                                            <div class="g-recaptcha" id="captcha" data-sitekey="6LcQilwmAAAAAB_Vse67owYFV6e5KZTs0kKQs4ky"></div>
                                        </div>
                                    </div>
                                    <button type="submit" id="submitButton" class="btn btn-gallo btn-Enviar">Enviar Postulación</button>
                                    <button class="btn btn-gallo hidden" id="enviando" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando Mensaje...
                                    </button>
                                    <button class="btn btn-gallo hidden" id="enviado" type="button" disabled>
                                        <i class="fa fa-check"></i> Enviado
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
        <script type="text/javascript" src="slick/slick.js"></script>
        <!-- Core theme JS-->
        
        <script src="js/scripts.js"></script>
        <script src="js/trabaja.js"></script>
    </body>
</html>