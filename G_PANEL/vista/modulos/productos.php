<?php if($_SESSION["tipo_user"] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing'){ ?>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="card-title">Productos</h2><br>
                            <div class="alert alert-warning" role="alert">
                                <span class="font-weight-bold">Tener en cuenta que la sección de productos debe de contener 8 items registrados, siguiendo esta recomendacion: <br> 
                                    1. Varillas <br>
                                    2. Alambre recocido <br>
                                    3. Clavos <br>
                                    4. Alam. de Púas <br>
                                    5. Mallas electrosoldadas <br>
                                    6. Alam. liso galvanizado <br>
                                    7. Armadura para pilares <br>
                                    8. Tejidos de Alambre</span>
                            </div>
                        </div>
                        <?php
                            $item = null;
                            $valor = null;
                            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
                            $cantProducto = count($productos);
                            if($cantProducto < 8){
                                echo '<div class="col-md-4 col-sm-12 mb-3">
                                    <span class="btn btn-primary bg-gradient float-md-right" data-toggle="modal" data-target="#Registro"><i class="fa fa-plus"></i> Nuevo Registro</span>
                                </div>';
                            }?>
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
                                                <th>Nombre Producto</th>
                                                <th>Descirpcion</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $item = null;
                                            $valor = null;
                                            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
                                            foreach ($productos as $key => $value){
                                                $item = 'id';
                                                $valor = $value['id_user'];
                                                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            
                                            ?>
                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value['nombre_producto']; ?></td>
                                                    <td width="400px"><?php echo $value['descripcion_producto']; ?></td>
                                                    <td><img class="img-120 img-thumbnail" src="<?php echo $value['imagen_producto']; ?>" alt=""></td>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="btn rounded-circle btn-warning btn-sm btnEditarProducto" idProducto="<?php echo $value['id'];?>" data-toggle="modal" data-target="#Actualizacion" title="Modificar Registro"><i class="fas fa-pencil-alt"></i></span>
                                                        <?php if($_SESSION['tipo_user'] == 'Administrador'){ ?>
                                                            <span class="btn rounded-circle btn-danger btn-sm btnEliminarProducto" idProducto="<?php echo $value["id"] ?>" fotoProducto="<?php echo $value["imagen_producto"] ?>" producto="<?php echo $value["nombre_producto"] ?>" title="Eliminar Registro"><i class="fas fa-trash"></i></span>
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

    <!-- Modal Registro-->
    <div class="modal fade" id="Registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-top: 3px solid #DE6262;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formulario" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del Producto:</label>
                                    <input type="text" id="nuevoProducto" name="nuevoProducto" class="form-control text-uppercase" required>
                                    <input type="hidden" name="nuevoIdUser" value="<?php echo $_SESSION['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Descripción:</label>
                                    <textarea id="nuevoProductoDescripcion" name="nuevoProductoDescripcion"  class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Subir Foto.</label>
                                    <input type="file" class="form-control nuevaFoto" name="nuevaFoto" required>
                                    <p class="help-block text-muted">Peso máximo de la foto 2MB</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center">
                                    <img src="vista/images/productos/anonymous.jpg" class="img-radius elevation-2 img-300 previsualizar align-self-center">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</button>
                    </div>
                    <?php 
                        $crearProducto = new ControladorProductos();
                        $crearProducto -> ctrCrearProducto(); 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Actualizacion-->
    <div class="modal fade" id="Actualizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-top: 3px solid #DE6262;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizacion de Registro de Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formulario" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del Producto:</label>
                                    <input type="text" id="editarProducto" name="editarProducto" class="form-control text-uppercase" required>
                                    <input type="hidden" id="editarId" name="editarId">
                                </div>
                                <div class="form-group">
                                    <label for="">Descripción:</label>
                                    <textarea id="editarProductoDescripcion" name="editarProductoDescripcion"  class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Subir Foto.</label>
                                    <input type="file" class="form-control nuevaFoto" name="editarFoto">
                                    <input type="hidden" name="fotoActual" id="fotoActual">
                                    <p class="help-block text-muted">Peso máximo de la foto 2MB</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center">
                                    <img src="vista/images/productos/anonymous.jpg" class="img-radius elevation-2 img-300 previsualizar previsualizarEditar align-self-center">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </div>
                    <?php 
                        $editarProducto = new ControladorProductos();
                        $editarProducto -> ctrEditarProducto(); 
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php 
        $borrarProducto = new ControladorProductos();
        $borrarProducto -> ctrBorrarProducto(); 
    ?>

    
    <script src="vista/js/producto.js"></script>

<?php } else {
    echo '<script>

	window.location = "sin-acceso";

    </script>';
} ?>