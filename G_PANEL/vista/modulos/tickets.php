<?php if($_SESSION["tipo_user"] == 'Administrador'){ ?>

<!-- PAGE CONTAINER-->

<div class="page-container">

    <!-- MAIN CONTENT-->

    <div class="main-content">

        <div class="row">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-6 col-sm-12">

                        <h2 class="card-title">Tickets de Trabajo</h2><br>

                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">

                        <span class="btn btn-success bg-gradient float-md-right m-1" data-toggle="modal"
                            data-target="#Reporte"><i class="fas fa-chart-bar"></i> Reporte</span>

                        <!--<span class="btn btn-info bg-gradient float-md-right m-1" id="btnBusqueda"><i class="fas fa-filter"></i> Busqueda Personalizada</span>--->

                        <span class="btn btn-primary bg-gradient float-md-right m-1" data-toggle="modal"
                            data-target="#Registro"><i class="fa fa-plus"></i> Nuevo Registro</span>

                    </div>

                </div>

                <div class="row" id="busqueda">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="modal-header bg-info">

                                <h5 class="modal-title" id="exampleModalLabel">Criterios de Búsquedas</h5>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-6">

                                        <div class="row">

                                            <div class="col-md-6 mb-2">

                                                <div class="form-floating">

                                                    <input type="text" id="ipAsignado" class="form-control pl-1"
                                                        data-index="5">

                                                    <label for="ipAsignado" class="text-bold">Asignado a</label>

                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-floating">

                                                    <input type="text" id="ipEstado" class="form-control"
                                                        data-index="6">

                                                    <label for="ipEstado" class="text-bold">Estado</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card elevation-3">

                    <div class="card-body">

                        <div class="card-title">

                        </div>

                        <div class="contenido">

                            <div class="responsive">

                                <table id="tablaTickets" class="table table-hover table-striped responsive"
                                    width="100%">

                                    <thead>

                                        <tr>

                                            <th width="30px">#</th>

                                            <th width="400px">Problema</th>

                                            <th>Prioridad</th>

                                            <th>Fecha de Solicitud</th>

                                            <th>Solicitado Por</th>

                                            <th>Asignado a</th>

                                            <th>Estado</th>

                                            <th>Acciones</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                            $item = null;

                                            $valor = null;

                                            $tickets = ControladorTicketsCord::ctrMostrarTicketsCord($item, $valor);

                                            foreach ($tickets as $key => $value){

                                                // Crear un objeto DateTime con una fecha y hora determinada

                                                $fechaHora = new DateTime($value['fecha_solicitud']);



                                                // Dar formato a la fecha y hora utilizando el método format

                                                $formateado = $fechaHora->format('d/m/Y H:i:s');

                                                

                                            

                                            ?>

                                        <tr>

                                            <td><?php echo $value['id']; ?></td>

                                            <td><?php echo $value['problema']; ?></td>

                                            <td>

                                                <?php 

                                                            if ($value['prioridad'] == 'Baja'){

                                                                echo '<div class="alert alert-success text-center" style="padding: 2px!important" role="alert">'.$value['prioridad'].'</div>';

                                                            } else if($value['prioridad'] == 'Media'){

                                                                echo '<div class="alert alert-warning text-center" style="padding: 2px!important" role="alert">'.$value['prioridad'].'</div>';

                                                            } else{

                                                                echo '<div class="alert alert-danger text-center" style="padding: 2px!important" role="alert">'.$value['prioridad'].'</div>';

                                                            }

                                                        ?>

                                            </td>



                                            <td><?php echo $formateado; ?></td>

                                            <td><?php echo $value['solicitado']; ?></td>

                                            <td><?php echo $value['asignado_a']; ?></td>

                                            <td>

                                                <?php 

                                                            if ($value['estado'] == 3){

                                                                echo '<div class="badge badge-danger text-center">Abierto</div>';

                                                            } else if ($value['estado'] == 2){

                                                                echo '<div class="badge badge-warning text-center">En Proceso</div>';

                                                            } else {

                                                                echo '<div class="badge badge-success text-center">Resuelto</div>';

                                                            }

                                                        ?>

                                            </td>

                                            </td>

                                            <td class="text-center">

                                                <span class="btn rounded-circle btn-success btn-sm btnVerTicket"
                                                    idTicket="<?php echo $value['id'];?>" data-toggle="modal"
                                                    data-target="#Ver" title="Verificar Registro"><i
                                                        class="fas fa-tasks"></i></span>

                                                <span class="btn rounded-circle btn-warning btn-sm btnEditarTicket"
                                                    idTicket="<?php echo $value['id'];?>" data-toggle="modal"
                                                    data-target="#Actualizacion" title="Modificar Registro"><i
                                                        class="fas fa-pencil-alt"></i></span>

                                                <span class="btn rounded-circle btn-danger btn-sm btnEliminarTicket"
                                                    idTicket="<?php echo $value["id"] ?>" title="Eliminar Registro"><i
                                                        class="fas fa-trash"></i></span>

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



<!-- Modal Cargando-->

<div class="modal fade" id="loader-carga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">

        <div class="loader-2"></div>

    </div>

</div>



<!-- Modal Registro-->
<div class="modal fade" id="Registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario-Tickets" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Problema:</label>
                                <textarea id="nuevoProblema" name="nuevoProblema" class="form-control" rows="2"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo de Problema:</label>
                                <select class="form-select" name="nuevoTipoProblema" id="nuevoTipoProblema" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="SAP">SAP</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Redes">Redes</option>
                                    <option value="Otros">Otros</option>
                                    <option value="Entrega de Insumos">Entrega de Insumos</option>
                                    <option value="Reparaciones">Reparaciones</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Prioridad del Trabajo:</label>
                                <select class="form-select" name="nuevoPrioridad" id="nuevoPrioridad" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Solicitado por:</label> <a onclick="NuevoUsuario()"
                                    class="text-primary">Agregar Nuevo Usuario</a>
                                <select class="form-select" name="nuevoSolicitadoPor" id="nuevoSolicitadoPor" required>
                                    <option value="">Seleccionar una Opción</option>
                                    <?php
                                            $item = 'estado_user';
                                            $valor = 1;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                        ?>
                                </select>
                                <input type="hidden" id="emailSolicitadoPor" name="emailSolicitadoPor">
                            </div>
                            <div class="form-group">
                                <label for="">Asignado a:</label>
                                <select name="nuevoAsignadoA" id="nuevoAsignadoA" class="form-select">
                                    <option value="">Seleccionar una Opción</option>
                                    <?php
                                            $item = 'id_rol';
                                            $valor = 1;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuariosRol($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                            $item = 'id_rol';
                                            $valor = 5;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuariosRol($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                        ?>
                                </select>
                                <input type="hidden" id="nuevoasignado" name="nuevoasignado" >
                                <input type="hidden" id="emailAsignadoA" name="emailAsignadoA" >
                            </div>
                            <div class="form-group">
                                <label for="">Sucursal:</label>
                                <select class="form-select" name="nuevoIdSucursal" id="nuevoIdSucursal" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="2">Casa Matriz - Capiatá</option>
                                    <option value="3">Suc. 1 - Fdo. de la Mora</option>
                                    <option value="4">Suc. 2 - Mariano Roque Alonso</option>
                                    <option value="5">Suc. 3 - Ñemby</option>
                                    <option value="6">Suc. 4 - Luque</option>
                                    <option value="7">Suc. 5 - Asunción</option>
                                    <option value="8">Suc. 6 - Capiatá</option>
                                    <option value="9">Suc. 7 - Ciudad del Este</option>
                                    <option value="10">Suc.8-Luque-San Bernardino<option>
                                    <option value="1">Todas las Sucursales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tiempo Estimado de Trabajo:</label>
                                <input type="datetime-local" name="nuevoTiempoEstimado" id="nuevoTiempoEstimado"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                    <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger"><i
                            class="fas fa-times"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Actualizacion-->
<div class="modal fade" id="Actualizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificación de Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario-Tickets-Update" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="idTickets" id="idTickets">
                                <input type="hidden" name="id" id="id" value = "1">
                                <label for="">Problema:</label>
                                <textarea id="editarProblema" name="editarProblema" class="form-control" rows="2"
                                    required></textarea>
                                <input type="hidden" name="problema" id="problema">
                            </div>
                            <div class="form-group">
                                <label for="editarTipoProblema">Tipo de Problema:</label>
                                <select id="editarTipoProblema" name="editarTipoProblema" class="form-select" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="SAP">SAP</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Redes">Redes</option>
                                    <option value="Otros">Otros</option>
                                    <option value="Entrega de Insumos">Entrega de Insumos</option>
                                    <option value="Reparaciones">Reparaciones</option>
                                </select>
                                <input type="hidden" name="tipoproblema" id="tipoproblema">
                            </div>
                            <div class="form-group">
                                <label for="">Prioridad del Trabajo:</label>
                                <select id="editarPrioridad" name="editarPrioridad" class="form-select" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                                <input type="hidden" name="prioridad" id="prioridad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Solicitado por:</label>
                                <select class="form-select" name="editarSolicitadoPor" id="editarSolicitadoPor"
                                    required>
                                    <option value="">Seleccionar una Opción</option>
                                    <?php
                                            $item = 'estado_user';
                                            $valor = 1;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                        ?>
                                </select>
                                <input type="hidden" id="emailSolicitadoPorEditar" name="emailSolicitadoPorEditar">
                                <input type="hidden" name="solicitado" id="solicitado">
                            </div>
                            <div class="form-group">
                                <label for="">Asignado a:</label>
                                <select name="editarAsignadoA" id="editarAsignadoA" class="form-select">
                                    <option value="">Seleccionar una Opción</option>
                                    <?php
                                            $item = 'id_rol';
                                            $valor = 1;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuariosRol($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                            $item = 'id_rol';
                                            $valor = 5;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuariosRol($item, $valor);
                                            foreach ($usuario as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre_user'].'</option>';
                                            }
                                        ?>
                                </select>
                                <input type="hidden" id="editarasignado" name="editarasignado">
                                <input type="hidden" id="emailAsignadoAEditar" name="emailAsignadoAEditar">
                                <input type="hidden" name="asignado" id="asignado">
                            </div>
                            <div class="form-group">
                                <label for="">Sucursal:</label>
                                <select class="form-select" name="editarIdSucursal" id="editarIdSucursal" required>
                                    <option value="">Seleccione una Opción</option>
                                    <option value="2">Casa Matriz - Capiatá</option>
                                    <option value="3">Suc. 1 - Fdo. de la Mora</option>
                                    <option value="4">Suc. 2 - Mariano Roque Alonso</option>
                                    <option value="5">Suc. 3 - Ñemby</option>
                                    <option value="6">Suc. 4 - Luque</option>
                                    <option value="7">Suc. 5 - Asunción</option>
                                    <option value="8">Suc. 6 - Capiatá</option>
                                    <option value="9">Suc. 7 - Ciudad del Este</option>
                                    <option value="10">Suc.8-Luque-SanBernardino<option>
                                    <option value="1">Todas las Sucursales</option>
                                </select>
                                <input type="hidden" name="sucursal" id="sucursal">
                            </div>
                            <div class="form-group">
                                <label for="">Tiempo Estimado de Trabajo:</label>
                                <input type="datetime-local" name="editarTiempoEstimado" id="editarTiempoEstimado"
                                    class="form-control">
                                    <!-- <input type="datetime-local" id="tiempo"  name="tiempo" style="display: none;"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                    <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger"><i
                            class="fas fa-times"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver-->
<div class="modal fade" id="Ver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambios de Proceso de Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario-editarTickets" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style="
                                line-height: 2.5em;
                            ">
                            <input type="hidden" name="id_Tickets" id="id_Tickets">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th width="200px"></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold">Fecha Solicitada:</td>
                                        <td id="fechaSolicitadaVer"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Problema:</td>
                                        <td id="problemaVer"></td>
                                        <input type="hidden" name="problemaInput" id="problemaInput">
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Tipo de Problema:</td>
                                        <td id="tipoproblemaVer"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Prioridad:</td>
                                        <td id="prioridadVer"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Solicitado por:</td>
                                        <td id="solicitadoporVer"></td>
                                        <input type="hidden" name="correo" id="correo">
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Asignado a:</td>
                                        <td id="asignadoaVer"></td>
                                        <input type="hidden" name="asiga" id="asiga">
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Sucursal:</td>
                                        <td id="sucursalVer"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-bold" for="">Comentarios del trabajo</label>
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-bold">Tiempo Estimado de Trabajo</label>
                                <input type="text" class="form-control" id="tiempo" name="" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="text-bold">Estado</label>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="3">Abierto</option>
                                        <option value="2">En Proceso</option>
                                        <option value="1">Resuelto</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text-bold">Fecha de Cierre</label>
                                    <input type="text" class="form-control" id="fechacierre" name="fechacierre"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reporte-->
<div class="modal fade" id="Reporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte de Tickets</h5>
                <button type="button" class="close btnCerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <center>
                        <form target="_blank" action="vista/modulos/Reportes/ReporteGraficoTickets.php" method="POST">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="imagen1" name="imagen1">
                                    <input type="hidden" class="form-control" id="imagen2" name="imagen2">
                                    <input type="hidden" class="form-control" id="imagen3" name="imagen3">
                                    <input type="hidden" class="form-control" id="total" name="total">
                                    <select class="form-control mb-2" name="year" id="year">
                                        <option value="">Seleccione año</option>
                                        <?php
                                                $item = null;
                                                $valor = null;
                                                $year = ControladorTicketsCord::ctrAñoTickets($item, $valor);
                                                foreach($year as $key => $value){
                                                    echo '<option value="'.$value[0].'">'.$value[0].'</option>';
                                                }
                                                ?>
                                    </select>
                                    <select class="form-control" name="mes" id="mes" disabled="true">
                                        <option value="">Seleccione mes</option>
                                        <?php
                                                $item = null;
                                                $valor = null;
                                                $mes = ControladorTicketsCord::ctrMesTickets($item, $valor);
                                                foreach($mes as $key => $value){
                                                    if($value[0] == 1){
                                                        $Mes = 'Enero';
                                                    } else if ($value[0] == 2){
                                                        $Mes = 'Febrero';
                                                    } else if ($value[0] == 3){
                                                        $Mes = 'Marzo';
                                                    } else if ($value[0] == 4){
                                                        $Mes = 'Abril';
                                                    } else if ($value[0] == 5){
                                                        $Mes = 'Mayo';
                                                    } else if ($value[0] == 6){
                                                        $Mes = 'Junio';
                                                    } else if ($value[0] == 7){
                                                        $Mes = 'Julio';
                                                    } else if ($value[0] == 8){
                                                        $Mes = 'Agosto';
                                                    } else if ($value[0] == 9){
                                                        $Mes = 'Septiembre';
                                                    } else if ($value[0] == 10){
                                                        $Mes = 'Octubre';
                                                    } else if ($value[0] == 11){
                                                        $Mes = 'Noviembre';
                                                    } else {
                                                        $Mes = 'Diciembre';
                                                    }
                                                    echo '<option value="'.$value[0].'">'.$Mes.'</option>';
                                                }
                                                ?>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <span class="btn btn-primary btnVisualizarReporte"><i class="fas fa-eye"></i>
                                        Visualizar</span>
                                    <button type="submit" class="btn btn-danger btnPDF" disabled><i
                                            class="fas fa-file-pdf"></i> Generar PDF</button>
                                    <span type="reset" class="btn btn-secondary btnCerrarModal" data-dismiss="modal"><i
                                            class="fas fa-times"></i> Cancelar</span>
                                </div>
                            </div>
                        </form>
                    </center>
                </div>
                <div class="row m-3">
                    <div class="container">
                        <div id="mensaje" class="row"></div>
                        <div id="contenidoReporte" class="row">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40 text-bold text-center">Estado Tickets</h3>
                                        <div style="width: 100%; height: 310px;">
                                            <canvas id="pieEstadoTicket"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40 text-bold text-center">Tickets por Persona Asignada
                                        </h3>
                                        <canvas id="barPersonaAsignada" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40 text-bold text-center">Tickets por Tipos de Problemas
                                        </h3>
                                        <canvas id="barTipoProblema" width="400" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else {
    echo '<script>
	window.location = "sin-acceso";
    </script>';
} ?>