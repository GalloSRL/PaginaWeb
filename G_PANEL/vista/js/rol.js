$(document).ready(function(){

    $('.btnNuevo').on('click', function(){
        $('.btnGuardar').removeClass('hidden');
        $('.btnNuevo').addClass('disabled');
        $('.btnCancelar').removeClass('hidden');
        $('.label-rol').removeClass('text-muted');
        $('#nuevoRol').removeAttr('disabled');
        $('#nuevoRol').focus();

        

    });

    $('.btnCancelar').on('click', function(){
        $('.btnGuardar').addClass('hidden');
        $('.btnNuevo').removeClass('disabled');
        $('.btnActualizar').addClass('hidden');
        $('.btnCancelar').addClass('hidden');
        $('.label-rol').addClass('text-muted');
        $('#nuevoRol').attr('disabled',true);

        $('#formulario-rol-nuevo').removeClass('hidden');
        $('#formulario-rol-actualizar').addClass('hidden');

        $('#formulario-rol-nuevo').trigger('reset');
        $('#formulario-rol-actualizar').trigger('reset');
    });

    $('.btnEditarRol').on('click', function(){
        var idRol = $(this).attr("idRol");
        
        var datos = new FormData();
        datos.append("idRol", idRol);

        $.ajax({

            url:"ajax/rol.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $('#formulario-rol-nuevo').addClass('hidden');
                $('#formulario-rol-actualizar').removeClass('hidden');
                
                $('#id_rol').val(respuesta['id']);
                $('#editarRol').val(respuesta['nombre_rol']);
                $('#editarRol').focus();

                $('.btnGuardar').addClass('hidden');
                $('.btnNuevo').addClass('disabled');
                $('.btnActualizar').removeClass('hidden');
                $('.btnCancelar').removeClass('hidden');

                $('#editarRol').removeAttr('disabled');

            }
        });
 
    });

    /*=============================================
    ELIMINAR ROL
    =============================================*/
    $(document).on("click", ".btnEliminarRol", function(){
        var idRol = $(this).attr("idRol");
        Swal.fire({
        title: '¿Está seguro de borrar el Rol?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar!'
        }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=roles&idRol="+idRol;
        }
        })
    });
})