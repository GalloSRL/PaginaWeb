<div class="page-content--bge5">
    <div class="container">
        <div class="login-wrap">
            <div class="login-content" style="background: #393939!important;">
                <div class="login-logo">
                    <a href="#">
                        <img src="vista/images/Logos/logo2.png" alt="Gallo-Panel">
                    </a>
                </div>
                <div class="login-form">
                    <form action="" method="post">
                        <input type="hidden" name="editarId" value="<?php echo $_SESSION["id"]; ?>">
                        <div class="form-group">
                            <label class="text-white">Contraseña Nueva</label>
                            <input class="au-input au-input--full" type="password" name="editarPassword" placeholder="Contraseña..." required>
                        </div>
                        <button class="btn btn-primary m-2" type="submit">Cambiar</button>
                        <a href="dashboard" class="btn btn-danger m-2">Cancelar</a>
                        <?php 

                            $editarContra = new ControladorUsuarios;
                            $editarContra -> ctrEditarContraseña();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>