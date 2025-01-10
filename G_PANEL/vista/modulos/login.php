<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALLO SRL - Login</title>
    <link rel="shortcut icon" href="vista/images/Logos/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="vista/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vista/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="vista/css/stylelogin.css">
    <script type="text/javascript" src="http://jrain.oscitas.netdna-cdn.com/tutorial/js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="back">
    <div class="demo form-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
                    <div class="form-container">
                        <div class="form-icon">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <form method="POST" class="form-horizontal">
                            <h3 class="title">Login</h3>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-user"></i></span>
                                <input class="form-control" id="ingUsuario" name="ingUsuario" type="text" autocomplete="off" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input class="form-control" id="ingPassword" name="ingPassword"  type="password" placeholder="Contraseña">
                            </div>
                            <button class="btn signin">Login</button>
                            <span class="forgot-pass"><p>Si Olvidó su contaseña, favor de contactar al Departamento de Informática</p></span>
                            <?php
                                $login = new ControladorUsuarios();
                                $login -> ctrIngresoUsuario();                                
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>