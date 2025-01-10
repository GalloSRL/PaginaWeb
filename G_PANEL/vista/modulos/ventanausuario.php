<div class="page-container">
<!-- MAIN CONTENT-->

    <div class="row">

        <div class="col-md-12">

            <div class="card elevation-3">

                <div class="card-body">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registro de Usuario</h5>
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

                                    <button type="button" id="btnCancelar" onclick="window.close()" class="btn btn-danger">Cancelar</button>

                                </div>

                                <?php 

                                    $crearUsuario = new ControladorUsuarios();

                                    $crearUsuario -> ctrCrearUsuarioVentana(); 

                                ?>

                            </form>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>