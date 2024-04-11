$(document).ready(function(){
    //Seccion de Usuario
    /*=============================================
    SUBIENDO LA FOTO DEL USUARIO
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
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load", function(event){
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src", rutaImagen);
            })
        }
    });

    /*=============================================
    EDITAR USUARIO
    =============================================*/
    $(document).on("click", ".btnEditarUsuario", function(){

        var idUsuario = $(this).attr("idUsuario");
        
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
                $('#editarId').val(respuesta['id']);
                $('#editarNombre').val(respuesta['nombre_user']);
                $('#editarUsuario').val(respuesta['usuario_user']);
                $('#editarRol').val(respuesta['id_rol']);
                $('#editarRol').val(respuesta['id_rol']);
                $('#editarTipoUser').val(respuesta['tipo_user']);
                $('#editarEmail').val(respuesta['email']);
                $("#passwordActual").val(respuesta["password_user"]);
            }
        });
    });
    /*=============================================
    ELIMINAR USUARIO
    =============================================*/
    $(document).on("click", ".btnEliminarUsuario", function(){
        var idUsuario = $(this).attr("idUsuario");
        var usuario = $(this).attr("usuario");
        Swal.fire({
        title: '¿Está seguro de borrar al usuario '+usuario+'?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar!'
        }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario;
        }
        })
    });
    /*=============================================
    ACTIVAR USUARIO
    =============================================*/
    $(document).on("click", ".btnActivarUsuario", function(){
        var idUsuario = $(this).attr("idUsuario");
        var estadoUsuario = $(this).attr('estadoUsuario');
        var datos = new FormData();
        datos.append("activarId", idUsuario);
        datos.append("activarUsuario", estadoUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                Swal.fire({
                    title: "El estado del Usuario ha sido modificado correctamente.",
                    icon: "success",
                    confirmButtonText: "¡Cerrar!"
                }).then(function(result) {         
                    if (result.value) {
                        window.location = "usuarios";
                    }
                });
            }
        })
    });

    /*=============================================
    VISUALIZAR USUARIO
    =============================================*/
    $(document).on("click", ".btnVerUsuario", function(){
        var idUsuario = $(this).attr("idUsuario");
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta){

                console.log(respuesta);

                if(respuesta['estado_user'] == 1){
                    $('.ribbon').removeClass('ribbon-danger');
                    $('.ribbon').addClass('ribbon-success');
                    $('#span').html('Activo');
                } else {
                    $('.ribbon').removeClass('ribbon-success');
                    $('.ribbon').addClass('ribbon-danger');
                    $('#span').html('Inactivo');
                }

                
                $('.tipoUsuario').html(respuesta['nombre_rol']);
                $('.nombreUsuario').html(respuesta['nombre_user']);
                $('.usuario_user').html(respuesta['usuario_user']);
                $('.usuario_email').html(respuesta['email']);

            }
                
        })
    });
});