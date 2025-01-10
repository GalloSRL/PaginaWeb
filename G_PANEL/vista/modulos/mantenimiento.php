<?php if ($_SESSION['tipo_user'] == 'Administrador') { ?>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="card-title">Mantenimiento</h2>
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
                                    <table class="table table-hover table-striped responsive tablaMantenimiento" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="30px">Nro.</th>
                                                <th>Fecha Realizada</th>
                                                <th>Sucursal</th>
                                                <th>Seccion</th>
                                                <th>Tipo de Equipo</th>
                                                <th>Usuario del Equipo</th>
                                                <th>Proxima Verificación</th>
                                                <th>Nro. Referencia</th>
                                                <th>Estado</th>
                                                <th width="120px">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <input type="hidden" value="<?php echo $_SESSION['tipo_user']; ?>" id="perfilOculto">
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
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Realizada:</label>
                                    <input type="date" id="nuevoFechaRealizada" name="nuevoFechaRealizada" class="form-control fechaRealizada" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Sucursal:</label>
                                    <select class="form-select" name="nuevoSucursal" id="nuevoSucursal" required>
                                        <option value="">Seleccione una Sucursal...</option>
                                        <option value="Casa Matriz - Capiatá">Casa Matriz - Capiatá</option>
                                        <option value="Suc. 1 - Fdo. de la Mora">Suc. 1 - Fdo. de la Mora</option>
                                        <option value="Suc. 2 - Mariano Roque Alonso">Suc. 2 - Mariano Roque Alonso</option>
                                        <option value="Suc. 3 - Ñemby">Suc. 3 - Ñemby</option>
                                        <option value="Suc. 4 - Luque">Suc. 4 - Luque</option>
                                        <option value="Suc. 5 - Asunción">Suc. 5 - Asunción</option>
                                        <option value="Suc. 6 - Capiatá">Suc. 6 - Capiatá</option>
                                        <option value="Suc. 7 - Ciudad del Este">Suc. 7 - Ciudad del Este</option>
                                        <option value="Suc. 8 - Luque - San Bernardino">Suc. 8 - Luque - San Bernardino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sección:</label>
                                    <input type="text" id="nuevoSeccion" name="nuevoSeccion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo de Equipo:</label>
                                    <select class="form-select" name="nuevoTipoEquipo" id="nuevoTipoEquipo" required>
                                        <option value="">Seleccione un Tipo de Equipo...</option>
                                        <option value="Notebook">Notebook</option>
                                        <option value="Pc de Escritorio">Pc de Escritorio</option>
                                        <option value="Impresora">Impresora</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Usuario del Equipo:</label>
                                    <input type="text" id="nuevoUsuario" name="nuevoUsuario" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Responsable del Trabajo:</label>
                                    <input type="text" id="nuevoResponsableRealizacion" name="nuevoResponsableRealizacion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Factura:</label>
                                    <input type="text" id="nuevoNroFactura" name="nuevoNroFactura" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Detalle del Trabajo:</label>
                                    <textarea  class="form-control" name="nuevoDetalle" id="nuevoDetalle" cols="20" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Referencia:</label>
                                    <input type=" number" id="nuevoReferencia" name="nuevoReferencia" min="0" class="form-control" value="0" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Proxima Revisión:</label>
                                    <input type="text" id="nuevoProximaRevision" name="nuevoProximaRevision" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $crearMantenimiento = new ControladorMantenimientos();
                        $crearMantenimiento -> ctrCrearMantenimiento(); 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Registro Referenciado-->
    <div class="modal fade" id="NuevoReferenciaMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Mantenimiento con Referencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Realizada:</label>
                                    <input type="date" id="nuevoRefeFechaRealizada" name="nuevoRefeFechaRealizada" class="form-control nuevofechaRealizada" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Sucursal:</label>
                                    <select class="form-select" name="nuevoRefeSucursal" id="nuevoRefeSucursal" required>
                                        <option value="">Seleccione una Sucursal...</option>
                                        <option value="Casa Matriz - Capiatá">Casa Matriz - Capiatá</option>
                                        <option value="Suc. 1 - Fdo. de la Mora">Suc. 1 - Fdo. de la Mora</option>
                                        <option value="Suc. 2 - Mariano Roque Alonso">Suc. 2 - Mariano Roque Alonso</option>
                                        <option value="Suc. 3 - Ñemby">Suc. 3 - Ñemby</option>
                                        <option value="Suc. 4 - Luque">Suc. 4 - Luque</option>
                                        <option value="Suc. 5 - Asunción">Suc. 5 - Asunción</option>
                                        <option value="Suc. 6 - Capiatá">Suc. 6 - Capiatá</option>
                                        <option value="Suc. 7 - Ciudad del Este">Suc. 7 - Ciudad del Este</option>
                                        <option value="Suc. 8 - Luque - San Bernardino">Suc. 8 - Luque - San Bernardino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sección:</label>
                                    <input type="text" id="nuevoRefeSeccion" name="nuevoRefeSeccion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo de Equipo:</label>
                                    <select class="form-select" name="nuevoRefeTipoEquipo" id="nuevoRefeTipoEquipo" required>
                                        <option value="">Seleccione un Tipo de Equipo...</option>
                                        <option value="Notebook">Notebook</option>
                                        <option value="Pc de Escritorio">Pc de Escritorio</option>
                                        <option value="Impresora">Impresora</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Usuario del Equipo:</label>
                                    <input type="text" id="nuevoRefeUsuario" name="nuevoRefeUsuario" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Responsable del Trabajo:</label>
                                    <input type="text" id="nuevoRefeResponsableRealizacion" name="nuevoRefeResponsableRealizacion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Factura:</label>
                                    <input type="text" id="nuevoRefeNroFactura" name="nuevoRefeNroFactura" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Detalle del Trabajo:</label>
                                    <textarea  class="form-control" name="nuevoRefeDetalle" id="nuevoRefeDetalle" cols="20" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Referencia:</label>
                                    <input type="number" id="nuevoRefeReferencia" name="nuevoRefeReferencia" min="0" class="form-control" value="0" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Proxima Revisión:</label>
                                    <input type="text" id="nuevoRefeProximaRevision" name="nuevoRefeProximaRevision" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $crearMantenimientoRef = new ControladorMantenimientos();
                        $crearMantenimientoRef -> ctrCrearMantenimientoRef(); 
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
                    <h5 class="modal-title" id="exampleModalLabel">Actualización de Registro de Mantenimientos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha Realizada:</label>
                                    <input type="date" id="editarFechaRealizada" name="editarFechaRealizada" class="form-control fechaRealizada" required>
                                    <input type="hidden" id="editarId" name="editarId" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Sucursal:</label>
                                    <select class="form-select" name="editarSucursal" id="editarSucursal" required>
                                        <option value="">Seleccione una Sucursal...</option>
                                        <option value="Casa Matriz - Capiatá">Casa Matriz - Capiatá</option>
                                        <option value="Suc. 1 - Fdo. de la Mora">Suc. 1 - Fdo. de la Mora</option>
                                        <option value="Suc. 2 - Mariano Roque Alonso">Suc. 2 - Mariano Roque Alonso</option>
                                        <option value="Suc. 3 - Ñemby">Suc. 3 - Ñemby</option>
                                        <option value="Suc. 4 - Luque">Suc. 4 - Luque</option>
                                        <option value="Suc. 5 - Asunción">Suc. 5 - Asunción</option>
                                        <option value="Suc. 6 - Capiatá">Suc. 6 - Capiatá</option>
                                        <option value="Suc. 7 - Ciudad del Este">Suc. 7 - Ciudad del Este</option>
                                        <option value="Suc. 8 - Luque - San Bernardino">Suc. 8 - Luque - San Bernardino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sección:</label>
                                    <input type="text" id="editarSeccion" name="editarSeccion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo de Equipo:</label>
                                    <select class="form-select" name="editarTipoEquipo" id="editarTipoEquipo" required>
                                        <option value="">Seleccione un Tipo de Equipo...</option>
                                        <option value="Notebook">Notebook</option>
                                        <option value="Pc de Escritorio">Pc de Escritorio</option>
                                        <option value="Impresora">Impresora</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Usuario del Equipo:</label>
                                    <input type="text" id="editarUsuario" name="editarUsuario" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Responsable del Trabajo:</label>
                                    <input type="text" id="editarResponsableRealizacion" name="editarResponsableRealizacion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Factura:</label>
                                    <input type="text" id="editarNroFactura" name="editarNroFactura" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Detalle del Trabajo:</label>
                                    <textarea  class="form-control" name="editarDetalle" id="editarDetalle" cols="20" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nro de Referencia:</label>
                                    <input type="number" id="editarReferencia" name="editarReferencia" class="form-control" min="0" required>
                                    <input type="hidden" id="editarIdReferencia" name="editarIdReferencia" class="form-control" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Proxima Revisión:</label>
                                    <input type="text" id="editarProximaRevision" name="editarProximaRevision" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $editarrMantenimiento = new ControladorMantenimientos();
                        $editarrMantenimiento -> ctrEditarMantenimiento(); 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Ver Datos registrados-->
    <div class="modal fade" id="Visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Visualizar Registro de Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="text-bold">Nro de registro: </span><span id="verId"></span><br>
                            <span class="text-bold">Fecha de Realización: </span><span id="verFechaRealización"></span><br>
                            <span class="text-bold">Sucursal: </span><span id="verSucursal"></span><br>
                            <span class="text-bold">Sección: </span><span id="verSeccion"></span><br>
                            <span class="text-bold">Tipo de Equipo: </span><span id="verTipoEquipo"></span><br>
                            <span class="text-bold">Usuario de Equipo: </span><span id="verUsuarioEquipo"></span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-bold">Responsable de Realización: </span><span id="verResponsable"></span><br>
                            <span class="text-bold">Nro de Factura: </span><span id="verFactura"></span><br>
                            <span class="text-bold">Detalle del Tabajo: </span><span id="verDetalle"></span><br>
                            <span class="text-bold">Próxima Revisión: </span><span id="verFechaRevision"></span><br>
                            <span class="text-bold">Nro de Referencia: </span><span id="verReferencia"></span><br>
                            <span class="text-bold">Estado: </span><span id="verEstado"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

<?php } else {
    echo '<script>

	window.location = "sin-acceso";

    </script>';
} ?>