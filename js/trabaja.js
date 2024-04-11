funcion = function(){
    estadoVacancia = 1;
    var datos = new FormData();
        datos.append("estadoVacancia", estadoVacancia);

    $.ajax({
        url:"G_PANEL/ajax/vacancias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta[0] > 0){
                $("#trabajaNosotros").removeClass('hidden');
                
            } else {
                $("#trabajaNosotros").addClass('hidden');
            }
        }
    });
}

$(document).ready(function(){
    /*=============================================
    VISUALIZAR VACANCIA
    =============================================*/
    $(document).on("click", ".btnVerVacancia", function(){

        var idVacancia = $(this).attr("idVacancia");
        // using slice
        var fecha = new Date().toISOString().split('T')[0];
        
        var datos = new FormData();
        datos.append("idVacancia", idVacancia);

        $.ajax({

            url:"G_PANEL/ajax/vacancias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                if (fecha >= respuesta['fecha_inicio'] & fecha <=  respuesta['fecha_fin']){
                    $('.btnPostularse').removeClass('disabled');
                } else {
                    $('.btnPostularse').addClass('disabled');
                }

                var prefix = '<i class="fas fa-arrow-alt-circle-right text-danger"></i> ';
                $("#vacancia").html('BUSCAMOS: '+ respuesta["vacancia"] + ' - '+respuesta['lugar_vacancia']);
                $("#idVacancia").val(respuesta['id']);
                $("#perfil").html(respuesta["perfil"]);
                $("#ofrece").html(respuesta['ofrece']);
                if(respuesta["id"] == idVacancia){
                    if (respuesta["valora"] != prefix){
                        $('.parte2').removeClass('hidden');
                        $("#valora").html(respuesta["valora"]);
                    } else {
                        $('.parte2').addClass('hidden');
                    }

                    if (respuesta["ofrece"] != prefix){
                        $('.parte3').removeClass('hidden');
                        $("#ofrece").html(respuesta["ofrece"]);
                    } else {
                        $('.parte3').addClass('hidden');
                    }
                }
                
                
                $('#foto').attr('src', 'G_PANEL/'+respuesta["flyer"]);
                $('#vigencia').html('<br>Vigencia: '+respuesta["fecha_inicio"]+' al '+respuesta["fecha_fin"]);

                

            }
        });
    });

    $('.btnPostularse').on('click', function(){

        var idVacancia = $('#idVacancia').val();
        var datos = new FormData();
        datos.append("idVacancia", idVacancia);

        $.ajax({
            url:"G_PANEL/ajax/vacancias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                
                $('#id_vacancia').val(respuesta['id']);
                $('#nombre_vacancia').val(respuesta['vacancia']);
                $('#conteo_vacancia').val(respuesta['conteo_postulaciones']);
            }
        });
    });

    function validarCampos(){
        var nombre = $("#post_nombre").val();
        var ci = $("#post_ci").val();
        var telefono = $("#post_telefono").val();
        var email = $("#post_email").val();
        var mensaje = $("#post_mensaje").val();

        if (nombre == "" || ci == "" || telefono == "" || email == "" || mensaje == "") {
            return false;
        } else {
            return true;
        }
    }

    $('#formulario-postulacion').on('submit', function (e) {
        e.preventDefault();
        validarCampos();
        if (validarCampos() == true) {
            var datos = new FormData($("#formulario-postulacion")[0]);

            $('#submitButton').addClass('hidden');
            $('#enviando').removeClass('hidden');

            $.ajax({
                url:"G_PANEL/vista/enviar-postulacion.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){

                if (respuesta == 1){
                    Swal.fire({
                    title: 'Alerta',
                    text: 'Favor de Validar el captCha.',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                    })
                }
        
                if (respuesta == 2){  
                    $('#enviado').removeClass('hidden');
                    $('#enviando').addClass('hidden');
                    $('#submitButton').addClass('hidden');    
                    Swal.fire({
                    title: 'Mensaje Enviado',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                    })
                }
        
                if (respuesta == 3){
                    Swal.fire({
                    title: 'Alerta',
                    text: 'Mensaje No Enviado',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                    })
                }
        
                if (respuesta == 4){
                    Swal.fire({
                    title: 'Alerta',
                    text: 'Error de captCha',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6',
                    }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                    })
                }
            
                }
            
            });
            
        }else {
            Swal.fire("Alerta", "Favor completar los campos vacios", 'warning');
        } 
    });
})
    
