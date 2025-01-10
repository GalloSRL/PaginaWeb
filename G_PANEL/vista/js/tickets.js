$(document).ready(function(){
    var table;
    table = $('#tablaTickets').DataTable({
        order: [[6, "asc"]]
    });
    //Se realiza la busqueda en DataTable por Asignación
    $('#ipAsignado').keyup(function (){
        table.column($(this).data('index')).search(this.value).draw();
    });
    //Se realiza la busqueda en DataTable por Estado
    $('#ipEstado').keyup(function (){
        table.column($(this).data('index')).search(this.value).draw();
    });

    /*=============================================
    Obtener el email del usuario quien solicita el ticket
    =============================================*/
    $('#nuevoSolicitadoPor').on('change', function(){
        var idUsuario = $('#nuevoSolicitadoPor').val();
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $("#emailSolicitadoPor").val(respuesta[0]['email']);
            }
        });
    })

    $('#editarSolicitadoPor').on('change', function(){
        var idUsuario = $('#editarSolicitadoPor').val();
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $("#emailSolicitadoPorEditar").val(respuesta[0]['email']);
            }
        });
    })

    /*=============================================
    Obtener el email del usuario a quien fue asignado el ticket
    =============================================*/
    $('#nuevoAsignadoA').on('change', function(){
        var idUsuario = $('#nuevoAsignadoA').val();
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $("#nuevoasignado").val(respuesta[0]['nombre_user']);
                $("#emailAsignadoA").val(respuesta[0]['email']);
            }
        });
    })

    $('#editarAsignadoA').on('change', function(){
        var idUsuario = $('#editarAsignadoA').val();
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $("#editarasignado").val(respuesta[0]['nombre_user']);
                $("#emailAsignadoAEditar").val(respuesta[0]['email']);
            }
        });
    })
    
    /*=============================================
    OBTENER LOS DATOS PARA MOSTRAR EN EL MODAL DE EDITAR
    =============================================*/
    $(document).on("click", ".btnEditarTicket", function(){
        var id = $(this).attr("idTicket");     
        var datos = new FormData();
        datos.append("id", id);
        $.ajax({
            url:"ajax/tickets.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(result){           
                
                $("#idTickets").val(result["id"]);
                $("#editarProblema").val(result["problema"]);
                $("#editarTipoProblema").val(result["tipo_problema"]);
                $("#editarPrioridad").val(result["prioridad"]);
                $("#editarSolicitadoPor").val(result["solicitado_por"]);
                $("#editarIdSucursal").val(result["id_sucursal"]);
                $("#editarTiempoEstimado").val(result["tiempo"]);


                $("#problema").val(result["problema"]);
                $("#tipoproblema").val(result["tipo_problema"]);
                $("#prioridad").val(result["prioridad"]);
                $("#solicitado").val(result["solicitado_por"]);
                $("#asignado").val(result["asignado_a"]);
                $("#sucursal").val(result["id_sucursal"]);
                // $("#tiempo").val(result["tiempo"]);
                
                //Se consulta el id del solicitado por para obtener el email del mismo
                var idUsuario = result["solicitado_por"];
                var datos = new FormData();
                datos.append("idUsuario", idUsuario);
                $.ajax({
                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res){
                        $("#emailSolicitadoPorEditar").val(res[0]['email']);
                    }
                });

                var asignadoA = null;

                if(result["asignado_a"] != null){
                    //Se consulta el nombre del usuario asignado a para obtener el email y el ID del mismo
                    var asignadoA = result["asignado_a"];
                    var datos = new FormData();
                    datos.append("Usuario", asignadoA);
                    $.ajax({
                        url:"ajax/usuarios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(resp){
                            $("#editarAsignadoA").val(resp[0]['id']);
                            $("#editarasignado").val(resp[0]['nombre_user']);
                            $("#emailAsignadoAEditar").val(resp[0]['email']);
                        }
                    });
                }
                
                
            }
        });
    });

    /*=============================================
    ELIMINAR Ticket
    =============================================*/
    $(document).on("click", ".btnEliminarTicket", function(){

        var BorradoId = $(this).attr("idTicket"); 

        Swal.fire({

        title: '¿Está seguro de borrar el Ticket?',

        text: "¡Si no lo está puede cancelar la accíón!",

        icon: 'question',

        showCancelButton: true,

        confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            cancelButtonText: 'Cancelar',

            confirmButtonText: 'Si, borrar!'

        }).then(function(result){

            if(result.value){

                var BorradoTicket = '1';

                var datos = new FormData();

                datos.append("BorradoId", BorradoId);

                datos.append("BorradoTicket", BorradoTicket);

                $.ajax({

                    url:"ajax/tickets.ajax.php",

                    method: "POST",

                    data: datos,

                    cache: false,

                    contentType: false,

                    processData: false,

                    dataType: "json",

                    success: function(respuesta){

                        if (respuesta == 'ok'){

                            Swal.fire({

                                icon: 'success',

                                title: 'El Ticket ha sido borrado correctamente',

                                showConfirmButton: true,

                                confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    if (result.value) {

                                        window.location = 'tickets';

                                    }

                            })

                        } else {

                            Swal.fire({

                                icon: 'error',

                                title: 'Error en el Borrado',

                                showConfirmButton: true,

                                confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    if (result.value) {

                                        window.location = 'tickets';

                                    }

                            })

                        }

                    }

                });

            }

        });

    });

    /*=============================================
    Ver Ticket
    =============================================*/
    $(document).on("click", ".btnVerTicket", function(){
        var id = $(this).attr("idTicket");
        var datos = new FormData();
        datos.append("id", id);
        $.ajax({
            url:"ajax/tickets.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                var sucursal = respuesta['id_sucursal'];
                var sucu;
                if (sucursal == 1){
                    sucu = 'Todas las Sucursales';
                } else if (sucursal == 2){
                    sucu = 'Casa Matriz - Capiatá';
                } else if (sucursal == 3){
                    sucu = 'Suc. 1 - Fdo. de la Mora';
                } else if (sucursal == 4){
                    sucu = 'Suc. 2 - Mariano Roque Alonso';
                } else if (sucursal == 5){
                    sucu = 'Suc. 3 - Ñemby';
                } else if (sucursal == 6){
                    sucu = 'Suc. 4 - Luque';
                } else if (sucursal == 7){
                    sucu = 'Suc. 5 - Asunción';
                } else if (sucursal == 8){
                    sucu = 'Suc. 6 - Capiatá';
                } else if (sucursal == 9){
                    sucu = 'Suc. 7 - Ciudad del Este';
                } else if (sucursal == 10){
                    sucu = 'Suc. 8 - Luque - San Bernardino';
                }
                var fechaSolicitud = moment(respuesta['fecha_solicitud']).format('DD-MM-YYYY');
                $("#id_Tickets").val(respuesta['id']);
                $("#fechaSolicitadaVer").html(' '+fechaSolicitud);
                $("#problemaVer").html(' '+respuesta['problema']);
                $("#problemaInput").val(respuesta['problema']);
                $("#tipoproblemaVer").html(' '+respuesta['tipo_problema']);
                $("#prioridadVer").html(' '+respuesta['prioridad']);
                if(respuesta['fecha_fin_trabajo'] == '0000-00-00 00:00:00'){
                    $("#fechacierre").val('');
                } else {
                    var fechaCierre = moment(respuesta['fecha_fin_trabajo']).format('DD-MM-YYYY HH:mm:ss'); 
                    $("#fechacierre").val(fechaCierre); 
                }
                $("#asignadoaVer").html(' '+respuesta['asignado_a']);
                $("#asiga").val(respuesta['asignado_a']);
                $("#sucursalVer").html(' '+sucu);
                $("#comentarios").val(respuesta['comentarios']); 
                $("#estado").val(respuesta['estado']);
                var fechaTiempo = moment(respuesta['tiempo']).format('DD-MM-YYYY HH:mm:ss');
                $("#tiempo").val(fechaTiempo);
                var idUsuario = respuesta['solicitado_por'];
                var datos = new FormData();
                datos.append("idUsuario", idUsuario);
                $.ajax({
                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res){
                        $("#solicitadoporVer").html(' '+res[0]['nombre_user']);
                        $("#correo").val(res[0]['email']);
                    }
                });
                var asignado = respuesta['asignado_a'];
                var datos = new FormData();
                datos.append("asignado", asignado);
                $.ajax({
                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(result){
                        $("#editarAsignadoA").val(result[0]['id']);
                    }
                });
            }
        });
    });

    /*=============================================
    Verificar Estado Ticket para completado de 
    campo de fecha de cierre
    =============================================*/
    $('#estado').change(function(){
        estado = $('#estado').val();
        if (estado == 1){
            var fecha = new Date();
            var fechaActual = moment(fecha).format('DD-MM-YYYY HH:mm:ss');
            $('#fechacierre').val(fechaActual);
            $('#comentarios').attr('required',true);
            var id = $("#id_Tickets").val();
            var datos = new FormData();
            datos.append("id", id);
            $.ajax({
                url:"ajax/tickets.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    $('#comentarios').val(respuesta['comentarios'] + '. Ticket Resuelto. ');
                }
            });
            $('#comentarios').focus();
        } else if (estado == 2){
            $('#fechacierre').val('');
            $('#comentarios').attr('required',false);
            var id = $("#id_Tickets").val();
            var datos = new FormData();
            datos.append("id", id);
            $.ajax({
                url:"ajax/tickets.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    $('#comentarios').val(respuesta['comentarios']);
                }
            });
        } else{
            $('#fechacierre').val('');
            $('#comentarios').attr('required',false);
            $('#comentarios').val('');
        }
    });
    $('#btnBusqueda').on('click', function (){
        $('#busqueda').removeClass('hidden');
    });
    $('.btnCerrarBusqueda').on('click', function (){
        $('#busqueda').addClass('hidden');
    });

    /*=============================================
    CREAR TICKETS CON ENVÍO DE CORREO  A LAS PARTES
    =============================================*/
    $('#formulario-Tickets').on('submit', function (e) {
        e.preventDefault();
        var data = new FormData($("#formulario-Tickets")[0]);
        $('#Registro').modal('hide').remove();
        $('#Registro').attr('data-dismiss', 'modal');
        $('#loader-carga').modal('show');
        $.ajax({
            url:"ajax/tickets.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                if(respuesta == 1){
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Exito...!!!',
                        text: 'El Ticket se ha registrado correctamente.',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                } else if (respuesta == 2){
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Error...!!!',
                        text: 'Correo no Enviado.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                } else {
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Error...!!!',
                        text: 'El ticket no se ha registrado.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                }
            }
        });
    });

    /*=============================================
    EDITAR TICKETS CON ENVÍO DE CORREO A LAS PARTES
    =============================================*/
    $('#formulario-Tickets-Update').on('submit', function (e) {
        e.preventDefault();
        console.log('Presiona');
        
        var data = new FormData($("#formulario-Tickets-Update")[0]);
        $('#Actualizacion').modal('hide').remove();
        $('#Actualizacion').attr('data-dismiss', 'modal');
        $('#loader-carga').modal('show');
        $.ajax({
            url:"ajax/tickets.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                
                if(respuesta == 1){
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Exito...!!!',
                        text: 'El Ticket se ha modificado correctamente.',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                } else if (respuesta == 2){
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Error...!!!',
                        text: 'Correo no Enviado.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                } else {
                    $('#loader-carga').modal('hide');
                    Swal.fire({
                        title: 'Error...!!!',
                        text: 'El ticket no se ha registrado.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'tickets';
                        }
                    });
                }
            }
        });
    });

    /*=============================================
    EDITAR TICKETS - LO CERRADO CON ENVÍO DE CORREO
    =============================================*/
    $('#formulario-editarTickets').on('submit', function (e) {
        e.preventDefault();
        let rol = $('#logueado').val();
        var data = new FormData($("#formulario-editarTickets")[0]);
        $('#Ver').modal('hide').remove();
        $('#Ver').attr('data-dismiss', 'modal');
        $('#loader-carga').modal('show');
        $.ajax({
            url:"ajax/ticketsCerrados.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                if(rol == 'Técnico'){
                    if(respuesta == 1){
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Exito...!!!',
                            text: 'El Ticket se ha actualizado correctamente.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'tickets-Tec';
                            }
                        });
                    } else if (respuesta == 2){
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Error...!!!',
                            text: 'Correo no Enviado.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'tickets-Tec';
                            }
                        });
                    } else {
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Error...!!!',
                            icon: "error",
                            title: "El ticket no ha sido editado ",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                window.location = "tickets-Tec";
                            }
                        });
                    }
                } else {
                    if(respuesta == 1){
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Exito...!!!',
                            text: 'El Ticket se ha actualizado correctamente.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'tickets';
                            }
                        });
                    } else if (respuesta == 2){
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Error...!!!',
                            text: 'Correo no Enviado.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'tickets';
                            }
                        });
                    } else {
                        $('#loader-carga').modal('hide');
                        Swal.fire({
                            title: 'Error...!!!',
                            icon: "error",
                            title: "El ticket no ha sido editado ",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                window.location = "tickets";
                            }
                        });
                    }
                }
            }
        });
    });
});

function NuevoUsuario(){
    window.open("ventanausuario", "_blank", "width=1000px, height=695px");
}