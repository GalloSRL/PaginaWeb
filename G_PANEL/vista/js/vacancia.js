$(document).ready(function(){
    //Seccion de Vacancias
    /*=============================================
    SUBIENDO LA FOTO DEL VACANCIA
    =============================================*/
    $(".nuevaFoto").change(function(){

        var imagen = this.files[0];
    
        /*=============================================
        VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG, PNG o WEBP
        =============================================*/

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png" && imagen["type"] != "image/webp"){
            $(".nuevaFoto").val("");
            Swal.fire({
                title: "Error al subir la imagen",
                text: "¡La imagen debe estar en formato JPG, PNG o WEBP",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
        }else if(imagen["size"] > 2000000){
            $(".nuevaFoto").val("");
            Swal.fire({
                title: "Error al subir la imagen",
                text: "¡La imagen no debe pesar más de 2MB!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
        }else{
            /*var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load", function(event){
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src", rutaImagen);
            })*/
        }
    });

    /*=============================================
    EDITAR VACANCIA
    =============================================*/
    $(document).on("click", ".btnEditarVacancia", function(){

        var idVacancia = $(this).attr("idVacancia");
        
        var datos = new FormData();
        datos.append("idVacancia", idVacancia);

        $.ajax({

            url:"ajax/vacancias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                var perfilOriginal1 = respuesta['perfil'];
                var perfilOriginal2 = perfilOriginal1.replaceAll('<br><i class="fas fa-arrow-alt-circle-right text-danger"></i> ','\n');
                var perfil = perfilOriginal2.replaceAll('<i class="fas fa-arrow-alt-circle-right text-danger"></i> ','');

                var ofreceOriginal1 = respuesta['ofrece'];
                var ofreceOriginal2 = ofreceOriginal1.replaceAll('<br><i class="fas fa-arrow-alt-circle-right text-danger"></i> ','\n');
                var ofrece = ofreceOriginal2.replaceAll('<i class="fas fa-arrow-alt-circle-right text-danger"></i> ','');
                

                var valoraOriginal1 = respuesta['valora'];
                var valoraOriginal2 = valoraOriginal1.replaceAll('<br><i class="fas fa-arrow-alt-circle-right text-danger"></i> ','\n');
                var valora = valoraOriginal2.replaceAll('<i class="fas fa-arrow-alt-circle-right text-danger"></i> ','');
               





                $("#editarId").val(respuesta["id"]);
                $("#editarVacancia").val(respuesta["vacancia"]);
                $("#editarPerfil").val(perfil);
                $("#editarOfrece").val(ofrece);
                $("#editarValora").val(valora);
                $("#editarLugarVacancia").val(respuesta["lugar_vacancia"]);
                $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
                $("#editarFechaFin").val(respuesta["fecha_fin"]);
                $("#fotoActual").val(respuesta["flyer"]);
            }
        });
    });
    /*=============================================
    ELIMINAR VACANCIA
    =============================================*/
    $(document).on("click", ".btnEliminarVacancia", function(){
        var idVacancia = $(this).attr("idVacancia");
        var fotoVacancia = $(this).attr("fotoVacancia");
        var vacancia = $(this).attr("vacancia");
        Swal.fire({
        title: '¿Está seguro de borrar la Vacancia?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar!'
        }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=vacancias&idVacancia="+idVacancia+"&vacancia="+vacancia+"&fotoVacancia="+fotoVacancia;
        }
        })
    });
    /*=============================================
    ACTIVAR VACANCIA
    =============================================*/
    $(document).on("click", ".btnActivar", function(){
        var idVacancia = $(this).attr("idVacancia");
        var estadoVacancia = $(this).attr('estadoVacancia');
        var datos = new FormData();
        datos.append("activarId", idVacancia);
        datos.append("activarVacancia", estadoVacancia);
        $.ajax({
            url:"ajax/vacancias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                Swal.fire({
                    title: "El estado de la vacancia ha sido modificado correctamente.",
                    icon: "success",
                    confirmButtonText: "¡Cerrar!"
                }).then(function(result) {         
                    if (result.value) {
                        window.location = "vacancias";
                    }
                });
            }
        })
    });

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

            url:"ajax/vacancias.ajax.php",
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
                
                
                $('#foto').attr('src', respuesta["flyer"]);
                $('#vigencia').html('<br>Vigencia: '+respuesta["fecha_inicio"]+' al '+respuesta["fecha_fin"]);

                

            }
        });
    });

    //Se realiza la validacion que si se presiono la tecla enter en el textarea del formulario de registro de una vacancia
    const perfil = document.getElementById('nuevoPerfil');

    perfil.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    const editarPerfil = document.getElementById('editarPerfil');

    editarPerfil.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    const ofrece = document.getElementById('nuevoOfrece');

    ofrece.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    const editarOfrece = document.getElementById('editarOfrece');

    editarOfrece.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    const valora = document.getElementById('nuevoValora');

    valora.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    const editarValora = document.getElementById('editarValora');

    editarValora.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' ) { // Verificar si se presionó la tecla "Enter"
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter
            console.log('Enter.')
            let currentValue = this.value;
            let cursorPosition = this.selectionStart;

            // Insertar el salto de línea en la posición del cursor
            let newValue = currentValue.substring(0, cursorPosition) + '\n' + currentValue.substring(cursorPosition);

            this.value = newValue;
            this.selectionStart = this.selectionEnd = cursorPosition + 1; // Mover el cursor después del salto de línea
        }
    });

    $('.btnPostularse').on('click', function(){

        var idVacancia = $('#idVacancia').val();
        var datos = new FormData();
        datos.append("idVacancia", idVacancia);

        $.ajax({
            url:"ajax/vacancias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $('#id').val(respuesta['id']);
                $('#conteoPostulacion').val(respuesta['conteo_postulaciones']);
                $('#nombre_vacancia').val(respuesta['vacancia']);
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
                url:"vista/enviar-postulacion.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
        
                console.log(respuesta);

                if (respuesta === 1){
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
});