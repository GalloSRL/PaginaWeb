<?php if($_SESSION["tipo_user"] == 'Técnico'){ ?>

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

                                            $item = 'asignado_a';

                                            $valor = $_SESSION["nombre_user"];

                                            $tickets = ControladorTicketsCord::ctrMostrarTicketsTec($item, $valor);

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

                                                <?php if ($value['solicitado'] == $_SESSION['nombre_user']) {
                                                ?>
                                                    <span class="btn rounded-circle btn-warning btn-sm btnEditarTicket"
                                                        idTicket="<?php echo $value['id'];?>" data-toggle="modal"
                                                        data-target="#Actualizacion" title="Modificar Registro"><i
                                                            class="fas fa-pencil-alt"></i></span>
                                                <?php } ?>
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
            <form id="formulario-Tickets-User" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="">Solicitado por:</label>
                            <input type="text" name="" id="" class="form-control" readonly value="<?php echo $_SESSION["nombre_user"] ?>">
                            <input type="hidden" name="nuevoSolicitadoPor" id="nuevoSolicitadoPor" value="<?php echo $_SESSION["id"] ?>">
                            <input type="hidden" name="logueado" id="logueado" value="<?php echo $_SESSION["tipo_user"] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="">Problema:</label>
                            <textarea id="nuevoProblema" name="nuevoProblema"  class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Prioridad del Trabajo:</label>
                            <select class="form-control" name="nuevoPrioridad" id="nuevoPrioridad">
                                <option value="">Seleccione una Opción</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        <input type="hidden" id="emailSolicitadoPor" name="emailSolicitadoPor" required value="<?php echo $_SESSION["email_user"] ?>">
                        <!-- <div class="form-group">

                            <label for="">Sucursal:</label>

                            <select data-placeholder="Seleccione una Opción" class="chosen-select" name="nuevoIdSucursal" id="nuevoIdSucursal">

                                <option value=""></option>

                                <option value="2">Casa Matriz - Capiatá</option>

                                <option value="3">Suc. 1 - Fdo. de la Mora</option>

                                <option value="4">Suc. 2 - Mariano Roque Alonso</option>

                                <option value="5">Suc. 3 - Ñemby</option>

                                <option value="6">Suc. 4 - Luque</option>

                                <option value="7">Suc. 5 - Asunción</option>

                                <option value="8">Suc. 6 - Capiatá</option>

                                <option value="9">Suc. 7 - Ciudad del Este</option> 

                                <option value="10">Suc. 8 - Luque - San Bernardino</option>                                         

                                <option value="1">Todas las Sucursales</option>

                            </select>

                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                    <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Actualizacion de Registro de Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario-editarTickets-user" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" id="idTickets" name="idTickets">
                            <label for="">Solicitado por:</label>
                            <input type="text" name="solicitadoPor" id="solicitadoPor" class="form-control" readonly>
                            <input type="hidden" name="editarSolicitadoPor" id="editarSolicitadoPor">
                            <input type="hidden" name="logueado" id="logueado" value="<?php echo $_SESSION["tipo_user"] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="">Problema:</label>
                            <textarea id="editarProblema" name="editarProblema"  class="form-control" rows="2" required></textarea>
                            <input type="hidden" id="problemahidden" name="problemahidden">
                        </div>
                        <div class="form-group">
                            <label for="">Prioridad del Trabajo:</label>
                            <select placeholder="Seleccione una Opción" class="form-control" name="editarPrioridad" id="editarPrioridad">
                                <option value=""></option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                            <input type="hidden" name="prioridadhidden" id="prioridadhidden">
                        </div>
                        <input type="hidden" id="editaremailSolicitadoPor" name="editaremailSolicitadoPor">
                        <input type="hidden" id="editaremailAsignadoA" name="editaremailAsignadoA">
                        <input type="hidden" id="editarAsignadoA" name="editarAsignadoA">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Guardar</button>
                    <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</button>
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
                <input type="hidden" name="logueado" id="logueado" value="<?php echo $_SESSION["tipo_user"] ?>" >
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

<?php } else {
    echo '<script>
	window.location = "sin-acceso";
    </script>';
} ?>