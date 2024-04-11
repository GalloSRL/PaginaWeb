<?php if ($_SESSION['tipo_user'] == 'Administrador') { ?>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="card-title">Usuarios</h2>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <span class="btn btn-primary bg-gradient float-md-right" data-toggle="modal" data-target="#Registro"><i class="fa fa-plus"></i> Nuevo Registro</span>
                        </div>
                    </div>
                    <div class="card elevation-3">
                        <div class="card-body">
                            <div class="card-title">
                            </div>
                            <div class="contenido">
                                <div class="">
                                    <table id="tabla" class="table table-hover table-striped responsive" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="30px">#</th>
                                                <th width="200px">Nombre</th>
                                                <th width="80px">Usuario</th>
                                                <th width="150px">Rol de Usuario</th>
                                                <th width="200px">E-Mail</th>
                                                <th width="80px">Estado</th>
                                                <th width="150px">Ultimo Lógin</th>
                                                <th width="120px">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $item = null;
                                            $valor = null;
                                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            foreach ($usuarios as $key => $value){
                                                $item = 'id';
                                                $valor = $value['id_rol'];
                                                $rol = ControladorRoles::ctrMostrarRoles($item, $valor);
                                            
                                            ?>
                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value['nombre_user']; ?></td>
                                                    <td><?php echo $value['usuario_user']; ?></td>
                                                    <td><?php echo $rol['nombre_rol']; ?></td>
                                                    <td><?php echo $value['email']; ?></td>
                                                    <td>
                                                    <?php 
                                                        if($value['estado_user'] != 0){
                                                            echo '<span class="badge badge-success">Activo</span>';
                                                        } else {
                                                            echo '<span class="badge badge-danger">Inactivo</span>';
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $value['ultimo_login_user'];?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="btn rounded-circle btn-info btn-sm btnVerUsuario" idUsuario="<?php echo $value['id'];?>" data-toggle="modal" data-target="#Visualizar" title="Ver Informacion del Registro"><i class="fas fa-eye"></i></span>
                                                        <?php 
                                                            if($value['estado_user'] != 0){
                                                                echo '<span class="btn rounded-circle btn-primary-light btn-sm mb-1 btnActivarUsuario" idUsuario="'.$value["id"].'" title="Activar/Desactivar Registro" estadoUsuario="0"><i class="fas fa-toggle-on text-success"></i></span>';
                                                            } else {
                                                                echo '<span class="btn rounded-circle btn-primary-light btn-sm mb-1 btnActivarUsuario" idUsuario="'.$value["id"].'" title="Activar/Desactivar Registro" estadoUsuario="1"><i class="fas fa-toggle-off text-danger"></i></span>';
                                                            }
                                                        ?>
                                                        <span class="btn rounded-circle btn-warning btn-sm btnEditarUsuario" idUsuario="<?php echo $value['id'];?>" data-toggle="modal" data-target="#Actualizacion" title="Modificar Registro"><i class="fas fa-pencil-alt"></i></span>
                                                        <span class="btn rounded-circle btn-danger btn-sm btnEliminarUsuario" idUsuario="<?php echo $value["id"] ?>" fotoUsuario="" usuario="<?php echo $value["nombre_user"] ?>" title="Eliminar Registro"><i class="fas fa-trash"></i></span>
                                                    </td>
                                                </tr>
                                            <?php
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
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

    <!-- Modal Registro-->
    <div class="modal fade" id="Registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nombre Completo:</label>
                                    <input type="text" id="nuevoNombre" name="nuevoNombre" class="form-control" required>
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Usuario:</label>
                                    <input type="text" id="nuevoUsuario" name="nuevoUsuario"  class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" id="nuevoPassword" name="nuevoPassword"  class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Rol de Usuario</label>
                                    <select id="nuevoRol" name="nuevoRol"  class="form-control" required>
                                        <option value="">Seleccione una Opción</option>
                                            <?php
                                            $item = 'estado_rol';
                                            $valor = 1;
                                            $roles = ControladorRoles::ctrMostrarRoles($item, $valor);
                                            foreach ($roles as $key => $value){?>

                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre_rol']; ?></option>
                                            
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" id="nuevoEmail" name="nuevoEmail" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $crearUsuario = new ControladorUsuarios();
                        $crearUsuario -> ctrCrearUsuario(); 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Actualizacion-->
    <div class="modal fade" id="Actualizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualización de Registro de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" id="editarId" name="editarId" class="form-control" required>
                                <div class="form-group">
                                    <label for="">Nombre Completo:</label>
                                    <input type="text" id="editarNombre" name="editarNombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Usuario:</label>
                                    <input type="text" id="editarUsuario" name="editarUsuario"  class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" id="editarPassword" name="editarPassword"  class="form-control">
                                    <input type="hidden" id="passwordActual" name="passwordActual" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo de Usuario</label>
                                    <select id="editarRol" name="editarRol" class="form-control" required>
                                        <option value="">Seleccione una Opción</option>
                                        <?php
                                            $item = 'estado_rol';
                                            $valor = 1;
                                            $roles = ControladorRoles::ctrMostrarRoles($item, $valor);
                                            foreach ($roles as $key => $value){?>

                                                <option  value="<?php echo $value['id']; ?>"><?php echo $value['nombre_rol']; ?></option>
                                            
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" id="editarEmail" name="editarEmail" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $editarUsuario = new ControladorUsuarios();
                        $editarUsuario -> ctrEditarUsuario(); 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Visualizar-->
    <div class="modal fade" id="Visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
            <div class="modal-content">
            <div class="ribbon ribbon-top-right"><span id="span"></span></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="vista/images/icon/user.png" alt="" class="img-fluid img-200"><br>
                            <span class="h3 nombreUsuario"></span><br>
                            <span class="h4 tipoUsuario text-muted"></span><hr><br>
                            <span class="h4 usuario_user"></span><br>
                            <span class="h5 usuario_email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $borrarUsuario = new ControladorUsuarios();
        $borrarUsuario -> ctrBorrarUsuario(); 
    ?>
<?php } else {
    echo '<script>

	window.location = "sin-acceso";

    </script>';
} ?>