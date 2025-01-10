<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <h2 class="card-title">Vacancias Laborales</h2>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                        <span class="btn btn-primary bg-gradient float-md-right" data-toggle="modal" data-target="#Registro"><i class="fa fa-plus"></i> Nueva Vacancia</span>
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
                                            <th>Vacancia</th>
                                            <th width="200px">Perfil</th>
                                            <th width="200px">Flyer</th>
                                            <th width="150px">Fecha de Inicio de Vigencia</th>
                                            <th width="150px">Fecha de Fin de Vigencia</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $item = null;
                                        $valor = null;
                                        $vacancias = ControladorVacancias::ctrMostrarVacancias($item, $valor);
                                        foreach ($vacancias as $key => $value)
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $value['vacancia']; ?></td>
                                                <td><?php echo $value['perfil']; ?></td>
                                                <td><img class="img-200 img-radius" src="<?php echo $value['flyer']; ?>" alt=""></td>
                                                <td><?php echo date('d-m-Y',strtotime($value['fecha_inicio']));?></td>
                                                <td><?php echo date('d-m-Y',strtotime($value['fecha_fin']));?></td>
                                                <td>
                                                <?php 
                                                    if($value['estado'] != 0){
                                                        echo '<span class="badge badge-success">Activo</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Inactivo</span>';
                                                    }
                                                ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="btn rounded-circle btn-info btn-sm mb-1 btnVerVacancia" idVacancia="<?php echo $value["id"] ?>"  data-toggle="modal" data-target="#Visualizar" title="Ver Informacion del Registro"><i class="fas fa-eye"></i></span>
                                                    <?php 
                                                        if($value['estado'] != 0){
                                                            echo '<span class="btn rounded-circle btn-primary-light btn-sm mb-1 btnActivar" idVacancia="'.$value["id"].'" title="Activar/Desactivar Registro" estadoVacancia="0"><i class="fas fa-toggle-on text-success"></i></span>';
                                                        } else {
                                                            echo '<span class="btn rounded-circle btn-primary-light btn-sm mb-1 btnActivar" idVacancia="'.$value["id"].'" title="Activar/Desactivar Registro" estadoVacancia="1"><i class="fas fa-toggle-off text-danger"></i></span>';
                                                        }
                                                    ?>
                                                    
                                                    <span class="btn rounded-circle btn-warning btn-sm mb-1 btnEditarVacancia" idVacancia="<?php echo $value["id"] ?>"  data-toggle="modal" data-target="#Actualizar" title="Modificar Registro"><i class="fas fa-pencil-alt"></i></span>
                                                    <span class="btn rounded-circle btn-danger btn-sm mb-1 btnEliminarVacancia" idVacancia="<?php echo $value["id"] ?>" fotoVacancia="<?php echo $value["flyer"] ?>" vacancia="<?php echo $value["vacancia"] ?>" title="Eliminar Registro"><i class="fas fa-trash"></i></span>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Nueva Vacancia Laboral</h5>
                <button type="button" id="btnCancelar" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre de la Vacancia:</label>
                                <input type="text" id="nuevoVacancia" name="nuevoVacancia" class="form-control text-uppercase" required>
                            </div>
                            <div class="form-group">
                                <label for="">Perfil Buscado:</label>
                                <textarea class="form-control" name="nuevoPerfil" id="nuevoPerfil" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Se Ofrece:</label>
                                <textarea class="form-control" name="nuevoOfrece" id="nuevoOfrece" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Se Valora:</label>
                                <textarea class="form-control" name="nuevoValora" id="nuevoValora" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Lugar de la Vacancia:</label>
                                <input type="text" class="form-control text-uppercase" name="nuevoLugarVacancia" id="nuevoLugarVacancia" required>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Inicio de Vigencia:</label>
                                <input type="date" class="form-control" name="nuevoFechaInicio" id="nuevoFechaInicio" required>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha Fin de Vigencia:</label>
                                <input type="date" class="form-control" name="nuevoFechaFin" id="nuevoFechaFin" required>
                            </div>
                            <div class="form-group">
                                <input type="file" class="nuevaFoto" name="nuevaFoto" required>
                                <p class="text-muted">Peso máximo de la foto 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" id="btnCancelar" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                </div>
                <?php 
                    $crearVacancia = new ControladorVacancias();
                    $crearVacancia -> ctrCrearVacancia(); 
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Modificar Registro-->
<div class="modal fade" id="Actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro de Vacancia Laboral</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="editarId" name="editarId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre de la Vacancia:</label>
                                <input type="text" id="editarVacancia" name="editarVacancia" class="form-control text-uppercase" required>
                            </div>
                            <div class="form-group">
                                <label for="">Perfil Buscado:</label>
                                <textarea class="form-control" name="editarPerfil" id="editarPerfil" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Se Ofrece:</label>
                                <textarea class="form-control" name="editarOfrece" id="editarOfrece" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Se Valora:</label>
                                <textarea class="form-control" name="editarValora" id="editarValora" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Lugar de la Vacancia:</label>
                                <input type="text" class="form-control  text-uppercase" name="editarLugarVacancia" id="editarLugarVacancia" required>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Inicio de Vigencia:</label>
                                <input type="date" class="form-control" name="editarFechaInicio" id="editarFechaInicio" required>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha Fin de Vigencia:</label>
                                <input type="date" class="form-control" name="editarFechaFin" id="editarFechaFin" required>
                            </div>
                            <div class="form-group">
                                <input type="file" class="nuevaFoto" name="editarFoto">
                                <p class="text-muted">Peso máximo de la foto 2MB</p>
                                <input type="hidden" name="fotoActual" id="fotoActual">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Actualizar</button>
                    <button type="button" id="btnCancelar" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                </div>
                <?php 
                    $editarVacancia = new ControladorVacancias();
                    $editarVacancia -> ctrEditarVacancia(); 
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Visualizar Registro Final-->
<div class="modal fade" id="Visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content" style="border-top: 3px solid #DE6262;">
            <div class="modal-header bg-danger">
                <h3 class="modal-title text-white font-weight-bold" id="exampleModalLabel">GALLO SRL - Vacancia Laboral</h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
                                    <button class="btn btn-info btnPostularse" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#Postulacion"><i class="fas fa-clipboard-list"></i> Postulate Aqui</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container">
                                <img id="foto" alt="Foto Vacancia" class="img-100x100 elevation-3 img-radius">
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data" id="formulario-postulacion" method="POST">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="vacancia" id="nombre_vacancia">
                    <input type="hidden" name="conteoPostulacion" id="conteoPostulacion">
                    <div class="row">
                        <div class="form-group">
                            <label class="fw-bold" for="">Nombre Completo:</label>
                            <input type="text" class="form-control" id="post_nombre" name="post_nombre" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold" for="">Numero de Cédula:</label>
                            <input type="text" class="form-control" id="post_ci" name="post_ci" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold" for="">Telefono:</label>
                            <input type="text" class="form-control" id="post_telefono" name="post_telefono" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold" for="">E-Mail:</label>
                            <input type="email" class="form-control" id="post_email" name="post_email" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold" for="">Mensaje:</label>
                            <textarea type="text" class="form-control" rows="3" id="post_mensaje" name="post_mensaje"></textarea>
                        </div>
                        <div class="form-group">
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
                            <button type="submit" id="submitButton" class="btn btn-primary btn-Enviar">Enviar Postulación</button>
                            <button class="btn btn-primary hidden" id="enviando" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando Mensaje...
                            </button>
                            <button class="btn btn-primary hidden" id="enviado" type="button" disabled>
                                <i class="fa fa-check"></i> Enviado
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
    $borrarVacancia = new ControladorVacancias();
    $borrarVacancia -> ctrBorrarVacancia(); 
?>

<script src="vista/js/vacancia.js"></script>