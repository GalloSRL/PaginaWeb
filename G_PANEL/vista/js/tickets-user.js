$(document).ready(function(){
    var table;
    table = $('#tablaTickets-user').DataTable({
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
    EDITAR Ticket
    =============================================*/
    $(document).on("click", ".btnEditarTicket", function(){
        var idTicket = $(this).attr("idTicket");     
        var datos = new FormData();
        datos.append("idTicket", idTicket);
        $.ajax({
            url:"ajax/tickets-user/tickets.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                var solicitadoPor = respuesta['solicitado_por'];
                var datos = new FormData();
                datos.append("idUsuario", solicitadoPor);
                $.ajax({
                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res){
                        $("#editarSolicitadoPor").val(res[0]['id']);
                        $("#solicitadoPor").val(res[0]['nombre_user']);
                        $("#editaremailSolicitadoPor").val(res[0]["email"]);
                    }
                });
                
                
                if(respuesta['asignado_a'] !== null){
                    var AsignadoA = respuesta['asignado_a'];
                    var datos = new FormData();
                    datos.append("Usuario", AsignadoA);
                    $.ajax({
                        url:"ajax/usuarios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(response){
                            $("#editaremailAsignadoA").val(response[0]['email']);
                            $("#editarAsignadoA").val(response[0]['nombre_user']);
                        }
                    });
                }


                $("#idTickets").val(respuesta["id"]);
                $("#editarProblema").val(respuesta["problema"]);
                $("#problemahidden").val(respuesta["problema"]);
                $("#editarPrioridad").val(respuesta["prioridad"]);
                $("#prioridadhidden").val(respuesta["prioridad"]);
                
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
    CREAR TICKETS CON ENVÍO DE CORREO
    =============================================*/
    $('#formulario-Tickets-User').on('submit', function (e) {
        e.preventDefault();
        let rol  = $('#logueado').val();
        var data = new FormData($("#formulario-Tickets-User")[0]);
        $('#Registro').modal('hide').remove();
        $('#Registro').attr('data-dismiss', 'modal');
        $('#loader-carga').modal('show');
        $.ajax({
            url:"ajax/tickets-user/tickets.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                if (rol == 'General') {
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
                                window.location = 'tickets-user';
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
                                window.location = 'tickets-user';
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
                                window.location = "tickets-user";
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
                }
            }
        });
    });

    /*=============================================
    EDITAR TICKETS - CON ENVÍO DE CORREO
    =============================================*/
    $('#formulario-editarTickets-user').on('submit', function (e) {
        e.preventDefault();
        let rol  = $('#logueado').val();
        var data = new FormData($("#formulario-editarTickets-user")[0]);
        $('#Actualizacion').modal('hide').remove();
        $('#Actualizacion').attr('data-dismiss', 'modal');
        $('#loader-carga').modal('show');
        $.ajax({
            url:"ajax/tickets-user/tickets.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                if (rol == 'General') {
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
                                window.location = 'tickets-user';
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
                                window.location = 'tickets-user';
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
                                window.location = "tickets-user";
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
                }
            }
        });
    });
});