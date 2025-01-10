<?php if($_SESSION["tipo_user"] == 'Administrador' || $_SESSION['tipo_user'] == 'Marketing'){ ?>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <h2 class="card-title">Clientes Registrados</h2><br>
                        </div>
                    </div>
                    <div class="card elevation-3">
                        <div class="card-body">
                            <div class="card-title">
                            </div>
                            <div class="contenido">
                                <div class="">
                                    <table id="tablaCliente" class="table table-hover table-striped responsive" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="30px">#</th>
                                                <th class="hidden">id</th>
                                                <th>U_TIPCONT</th>
                                                <th>U_CRID</th>
                                                <th>LicTradNum</th>
                                                <th>CardName</th>
                                                <th>U_CRSI</th>
                                                <th>E_Mail</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Street</th>
                                                <th>AdresType</th>
                                                <th>StreetNo</th>
                                                <th>U_EXX_FE_DEPT</th>
                                                <th>U_EXX_FE_DIST</th>
                                                <th>U_EXX_FE_BALO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $item = null;
                                            $valor = null;
                                            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                                            foreach ($clientes as $key => $value){
                                                
                                            
                                            ?>
                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td class="hidden"><?php echo $value['id'];; ?></td>
                                                    <td><?php echo $value['u_tipcont']; ?></td>
                                                    <td><?php echo $value['u_crid']; ?></td>
                                                    <td><?php echo $value['lictradnum']; ?></td>
                                                    <td><?php echo $value['cardname']; ?></td>
                                                    <td><?php echo $value['u_crsi']; ?></td>
                                                    <td><?php echo $value['e_mail']; ?></td>
                                                    <td><?php echo $value['phone']; ?></td>
                                                    <td><?php echo $value['address']; ?></td>
                                                    <td><?php echo $value['Street']; ?></td>
                                                    <td><?php echo $value['AdresType']; ?></td>
                                                    <td><?php echo $value['StreetNo']; ?></td>
                                                    <td><?php echo $value['U_EXX_FE_DEPT']; ?></td>
                                                    <td><?php echo $value['U_EXX_FE_DIST']; ?></td>
                                                    <td><?php echo $value['U_EXX_FE_BALO']; ?></td>
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

<?php } else {
    echo '<script>

	window.location = "sin-acceso";

    </script>';
} ?>