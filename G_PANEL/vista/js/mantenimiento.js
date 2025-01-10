/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

var perfilOculto = $("#perfilOculto").val();

$('.tablaMantenimiento').DataTable( {
    "ajax": "ajax/datatable-mantenimiento.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true
} );

$(document).ready(function(){
    $('.fechaRealizada').on('change', function(){

        const fecha = document.getElementById("nuevoFechaRealizada");
        const editarfecha = document.getElementById("editarFechaRealizada");
        const newfecha = document.getElementById("nuevoRefeFechaRealizada");
        const fechaSumada = new Date(fecha.value);
        fechaSumada.setDate(fechaSumada.getDate() + 180);

        const fechaFormateada = fechaSumada.toLocaleDateString("es-PY", {
            timeZone: "America/Asuncion"
        });
        // Mostramos la fecha sumada
        document.getElementById("nuevoProximaRevision").value = fechaFormateada;

        const editarfechaSumada = new Date(editarfecha.value);
        editarfechaSumada.setDate(editarfechaSumada.getDate() + 180);

        const editarfechaFormateada = editarfechaSumada.toLocaleDateString("es-PY", {
            timeZone: "America/Asuncion"
        });
        // Mostramos la fecha sumada
        document.getElementById("editarProximaRevision").value = editarfechaFormateada;
    });

    $('.nuevofechaRealizada').on('change', function(){

        const fecha = document.getElementById("nuevoRefeFechaRealizada");
        const fechaSumada = new Date(fecha.value);
        fechaSumada.setDate(fechaSumada.getDate() + 180);

        const fechaFormateada = fechaSumada.toLocaleDateString("es-PY", {
            timeZone: "America/Asuncion"
        });
        // Mostramos la fecha sumada
        document.getElementById("nuevoRefeProximaRevision").value = fechaFormateada;
    });

    /*=============================================
    ELIMINAR MANTENIMIENTO
    =============================================*/
    $(".tablaMantenimiento tbody").on("click", "span.btnEliminarMantenimiento", function(){
        var idMantenimiento = $(this).attr("idMantenimiento");
        var datos = new FormData();
        datos.append("idMante", idMantenimiento);
        $.ajax({

            url:"ajax/mantenimientos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if (respuesta == 0){
                    Swal.fire({
                        title: '¿Está seguro de borrar el Mantenimiento?',
                        text: "¡Si no lo está puede cancelar la accíón!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Si, borrar!'
                    }).then(function(result){
                        if(result.value){
                            var BorradoMantenimiento = '1';        
                            var data = new FormData();
                            data.append("BorradoId", idMantenimiento);
                            data.append("BorradoMantenimiento", BorradoMantenimiento);
                            $.ajax({
                                url:"ajax/mantenimientos.ajax.php",
                                method: "POST",
                                data: data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function(respuesta){
                                    if (respuesta == 'ok'){
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'El Mantenimiento ha sido borrado correctamente',
                                            showConfirmButton: true,
                                            confirmButtonText: 'Cerrar'
                                            }).then(function(result){
                                                if (result.value) {
                                                    window.location = 'mantenimiento';
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
                                                    window.location = 'mantenimiento';
                                                }
                                        })
                                    }
                                }
                            });
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'No Puedes Eliminar este Registro. Tienes Datos Asociados.',
                        text: "Realiza una Búsqueda con la Referencia: "+idMantenimiento,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
                
                
        });
    });

    /*=============================================
    MODIFICAR MANTENIMIENTO
    =============================================*/

    $(".tablaMantenimiento tbody").on("click", "span.btnEditarMantenimiento", function(){
        var idMantenimiento = $(this).attr("idMantenimiento");
        
        var datos = new FormData();
        datos.append("idMantenimiento", idMantenimiento);

        $.ajax({

            url:"ajax/mantenimientos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                document.getElementById("editarId").value = respuesta['id'];
                document.getElementById("editarFechaRealizada").value = respuesta['fecha_realizada'];
                document.getElementById("editarSucursal").value = respuesta['sucursal'];
                document.getElementById("editarSeccion").value = respuesta['seccion'];
                document.getElementById("editarTipoEquipo").value = respuesta['tipo_equipo'];
                document.getElementById("editarUsuario").value = respuesta['usuario'];
                document.getElementById("editarResponsableRealizacion").value = respuesta['responsable_realizacion'];
                document.getElementById("editarNroFactura").value = respuesta['nro_factura'];
                document.getElementById("editarDetalle").value = respuesta['detalle'];
                document.getElementById("editarReferencia").value = respuesta['referencia'];
                document.getElementById("editarIdReferencia").value = respuesta['referencia'];
                document.getElementById("editarProximaRevision").value = respuesta['proxima_revision'];


            }
        });

    });

    /*=============================================
    NUEVO MANTENIMIENTO REFERENCIADO
    =============================================*/
    $(".tablaMantenimiento tbody").on("click", "span.btnNuevoMantenimiento", function(){
        var idMantenimiento = $(this).attr("idMantenimiento");
        
        var datos = new FormData();
        datos.append("idMantenimiento", idMantenimiento);

        $.ajax({

            url:"ajax/mantenimientos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                document.getElementById("nuevoRefeSucursal").value = respuesta['sucursal'];
                document.getElementById("nuevoRefeSeccion").value = respuesta['seccion'];
                document.getElementById("nuevoRefeTipoEquipo").value = respuesta['tipo_equipo'];
                document.getElementById("nuevoRefeUsuario").value = respuesta['usuario'];
                document.getElementById("nuevoRefeReferencia").value = respuesta['id'];
            }
        });

    });

    /*=============================================
    VISUALIZAR MANTENIMIENTO
    =============================================*/
    $(".tablaMantenimiento tbody").on("click", "span.btnVerMantenimiento", function(){
        var idMantenimiento = $(this).attr("idMantenimiento");
        
        var datos = new FormData();
        datos.append("idMantenimiento", idMantenimiento);

        $.ajax({

            url:"ajax/mantenimientos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                var fechaRealizada = new Date(respuesta['fecha_realizada']);
                const fechaFormateada = fechaRealizada.toLocaleDateString("es-PY", {
                    timeZone: "America/Asuncion"
                });

                var proximaRevision = new Date(respuesta['proxima_revision']);
                const fechaFormateadaRevision = proximaRevision.toLocaleDateString("es-PY", {
                    timeZone: "America/Asuncion"
                });

                if(respuesta['estado'] == 'Pendiente'){
                    document.getElementById("verEstado").innerHTML = '<span class="badge badge-warning">'+respuesta['estado']+'</span>'
                } else{
                    document.getElementById("verEstado").innerHTML = '<span class="badge badge-primary">'+respuesta['estado']+'</span>'
                }


                document.getElementById("verId").textContent = respuesta['id'];
                document.getElementById("verFechaRealización").textContent = fechaFormateada;
                document.getElementById("verSucursal").textContent = respuesta['sucursal'];
                document.getElementById("verSeccion").textContent = respuesta['seccion'];
                document.getElementById("verTipoEquipo").textContent = respuesta['tipo_equipo'];
                document.getElementById("verUsuarioEquipo").textContent = respuesta['usuario'];
                document.getElementById("verResponsable").textContent = respuesta['responsable_realizacion'];
                document.getElementById("verFactura").textContent = respuesta['nro_factura'];
                document.getElementById("verDetalle").textContent = respuesta['detalle'];
                document.getElementById("verFechaRevision").textContent = fechaFormateadaRevision;
                document.getElementById("verReferencia").textContent = respuesta['referencia'];
                
            }
        });

    });


});