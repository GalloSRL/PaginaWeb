<?php if ($_SESSION['tipo_user'] == 'Administrador') { ?>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="card-title">Roles de Usuario</h2>
                        </div>
                    </div>
                    <div class="card elevation-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="POST" id="formulario-rol-nuevo">
                                        <button type="button" class="btn btn-primary btnNuevo mb-1"><i class="fas fa-plus"></i> Nuevo</button>

                                        <div class="form-group col-10 mt-3 mb-3">
                                            <label class="label-rol text-muted" for=""><b>Ingrese el nombre del Rol a Registrar.</b></label>
                                            <input type="text" class="form-control" name="nuevoRol" id="nuevoRol" disabled required>
                                            <input type="hidden" id="id_user" name="id_user" value="<?php echo $_SESSION['id'] ?>">
                                        </div>

                                        <button type="submit" class="btn btn-success hidden btnGuardar mb-2"><i class="fas fa-save"></i> Guardar</button>
                                        <button type="button" class="btn btn-danger hidden btnCancelar mb-2"><i class="fas fa-times"></i> Cancelar</button>
                                        <?php 
                                            $nuevoRol = new ControladorRoles();
                                            $nuevoRol->ctrCrearRol();
                                        ?>
                                    </form>
                                    <form method="POST" id="formulario-rol-actualizar" class="hidden">
                                        <button type="button" class="btn btn-primary btnNuevo mb-1"><i class="fas fa-plus"></i> Nuevo</button>

                                        <div class="form-group col-10 mt-3 mb-3">
                                            <label class="label-rol text-muted" for=""><b>Modifique el Nombre del Rol.</b></label>
                                            <input type="text" class="form-control" name="editarRol" id="editarRol" required>
                                            <input type="hidden" id="id_rol" name="id_rol">
                                        </div>

                                        <button type="submit" class="btn btn-warning hidden btnActualizar mb-2"><i class="fas fa-save"></i> Modificar</button>
                                        <button type="button" class="btn btn-danger hidden btnCancelar mb-2"><i class="fas fa-times"></i> Cancelar</button>
                                        <?php 
                                            $editarRol = new ControladorRoles();
                                            $editarRol->ctrEditarRoles();
                                        ?>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="responsive">
                                        <table id="tabla" class="table table-hover table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre del Rol</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $item = 'estado_rol';
                                                    $valor = 1;
                                                    $roles = ControladorRoles::ctrMostrarRoles($item, $valor);
                                                    foreach ($roles as $key => $value)
                                                    {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $key+1; ?></td>
                                                            <td><?php echo $value['nombre_rol']; ?></td>
                                                            <td>
                                                                <span class="btn rounded-circle btn-warning btn-sm btnEditarRol" idRol="<?php echo $value['id'];?>" title="Modificar Registro"><i class="fas fa-pencil-alt"></i></span>
                                                                <span class="btn rounded-circle btn-danger btn-sm btnEliminarRol" idRol="<?php echo $value["id"] ?>" title="Eliminar Registro"><i class="fas fa-trash"></i></span>
                                                            </td>
                                                        </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <?php 
        $borrarRoles = new ControladorRoles();
        $borrarRoles -> ctrBorrarRoles(); 
    
} else {
    echo '<script>

	window.location = "sin-acceso";

    </script>';
} ?>