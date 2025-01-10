<div class="box">
    <div class="text-center">
        <a href="https://www.gallosrl.com.py"><img class="d-block mx-auto mb-2 img" width="250px" src="../assets/logo.png" alt=""></a>
        <h5 class="subrayado">ACTUALIZACIÓN DE DATOS PARA LA FACTURACIÓN ELECTRÓNICA</h5>
    </div>
    <div class="row Registro">
        <div class="col-md-12">
            <center>
                <div class="col-md-12sssss col-sm-12 col-xs-12">
                    <form id="formul" class="needs-validation" method="POST" novalidate>
                        <?php
                            $crear = new ControladorDatosClientes();
                            $crear -> ctrCrearCliente();
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12 p-2">
                                    <input type="hidden" name="idCliente" id="idCliente">
                                    <label for="nuevoTipoContri" class="form-label float-start"><span class="text-danger">*</span> Tipo de contribuyente</label>
                                    <select class="form-select" id="nuevoTipoContri" name="nuevoTipoContri" required>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                        <option value="1">Persona Física</option>
                                        <option value="2">Persona Jurídica</option>
                                    </select>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoTipoIdent" class="form-label float-start"><span class="text-danger">*</span> Tipo Identificación</label>
                                    <select class="form-select" id="nuevoTipoIdent" name="nuevoTipoIdent" required>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                        <option value="CARNE_RESIDENCIA">Carnet de Residencia para Extranjeros</option>
                                        <option value="CEDULA">Cedula de Identidad Nacional</option>
                                        <option value="CLIENTE_EXTERIOR">Cliente del Exterior</option>
                                        <option value="DIPLOMATICO">Diplomático</option>
                                        <option value="IDENTIFICACION_FISCAL_EX">Identificación Fiscal Extranjero</option>
                                        <option value="IDENTIFICACION_TRIBUTARIO ">RUC</option>
                                        <option value="OTRO">Otro</option>
                                        <option value="PASAPORTE">Pasaporte</option>
                                        <option value="SIN NOMBRE">Sin Nombre</option>
                                    </select>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoRuc" class="form-label float-start"><span class="text-danger">*</span> RUC</label>
                                    <input type="text" class="form-control" id="nuevoRuc" name="nuevoRuc"  oninput="validateInput(this)" required>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoRazonSocial" class="form-label float-start"><span class="text-danger">*</span> Razón Social</label>
                                    <input type="text" class="form-control text-uppercase" id="nuevoRazonSocial" name="nuevoRazonSocial" required>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoSituacion" class="form-label float-start"><span class="text-danger">*</span> Situación</label>
                                    <select class="form-select" id="nuevoSituacion" name="nuevoSituacion" required>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                        <option value="CONTRIBUYENTE">Contribuyentes</option>
                                        <option value="NO_CONTRIBUYENTE">No Contribuyentes</option>
                                        <option value="NO_RESIDENTE">No Residentes en el País</option>
                                    </select>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoEmail" class="form-label float-start"><span class="text-danger">*</span> Correo Electrónico</label>
                                    <input type="email" class="form-control text-lowercase" id="nuevoEmail" name="nuevoEmail" required>
                                    <div class="invalid-feedback float-start">
                                        Proporciona un correo válido.
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 p-2">
                                    <label for="nuevoTelefono" class="form-label float-start"><span class="text-danger">*</span> Número de Contacto</label>
                                    <input type="text" class="form-control" id="nuevoTelefono" max="12" name="nuevoTelefono" oninput="validateInputTelefono(this)" required>
                                </div>
                                <div class="col-md-12 p-2 hidden">
                                    <label for="nuevoIdDireccion" class="form-label float-start"><span class="text-danger">*</span> ID Direccion</label>
                                    <input type="text" class="form-control" id="nuevoIdDireccion" name="nuevoIdDireccion" value="Particular" readonly required>
                                </div>
                                <div class="col-md-12 p-2 hidden">
                                    <label for="nuevoTipoDireccion" class="form-label float-start"><span class="text-danger">*</span> Tipo de Direccion de Domicilio</label>
                                    <input type="text" class="form-control" id="nuevoTipoDireccion" name="nuevoTipoDireccion" value="B" required readonly>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoCalle" class="form-label float-start"><span class="text-danger">*</span> Calle de Domicilio</label>
                                    <input type="text" class="form-control text-uppercase" id="nuevoCalle" name="nuevoCalle" required>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoNroCasa" class="form-label float-start"><span class="text-danger">*</span> Nro. de Casa</label>
                                    <input type="number" class="form-control" min="0" id="nuevoNroCasa" name="nuevoNroCasa" value="0" required>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoDepartamento" class="form-label float-start"><span class="text-danger">*</span> Departamento</label>
                                    <select class="form-select" id="nuevoDepartamento" name="nuevoDepartamento" required>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                        <?php
                                            $item = null;
                                            $valor = null;
                                            $departamento = ControladorDatosClientes::ctrMostrarDepartamento($item, $valor);
                                            foreach($departamento as $key => $valueDpto){?>
                                                <option value="<?php echo $valueDpto['id']; ?>"><?php echo $valueDpto['departamento']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoDistrito" class="form-label float-start"><span class="text-danger">*</span> Distrito</label>
                                    <select class="form-select" id="nuevoDistrito" name="nuevoDistrito" required disabled>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                    </select>
                                </div>
                                <div class="col-md-12 p-2">
                                    <label for="nuevoBarrio" class="form-label float-start"><span class="text-danger">*</span> Barrio</label>
                                    <select class="form-select" id="nuevoBarrio" name="nuevoBarrio" required disabled>
                                        <option selected disabled value="">Seleccione una opción...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 p-2">
                            <div class="g-recaptcha" id="captcha" name="captcha" data-sitekey="6LcQilwmAAAAAB_Vse67owYFV6e5KZTs0kKQs4ky"></div>
                        </div>
                        <div class="col-12 m-2">
                            <button class="btn btn-danger btnGuardar" type="submit">Guardar Registro</button>
                            <button class="btn btn-warning btnActualizar hidden" type="submit">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
</div>

