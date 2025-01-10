// Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
(function () {
    'use strict'

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('.needs-validation')

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

$(document).ready(function(){
    $("#nuevoRuc").change(function(){
        $(".alert").remove();
        var cliente = $(this).val();
        var datos = new FormData();
        datos.append("validarCliente", cliente);
        $.ajax({
            url:"ajax/cliente.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta){
                    $("#nuevoRuc").parent().after('<div class="alert alert-warning alert-dismissible fade show" role"alert">Este RUC ya existe en la base de datos. Si desea actualizar sus datos favor presione <button type="button" class="btn btn-light btnEditarCliente" idCliente="'+respuesta['id']+'"><i class="fas fa-right-long"></i> aquí</button><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    $("#nuevoRuc").val("");
                }
            }
        });
    });

    $(document).on('click', '.btnEditarCliente', function(){
        $('.btnGuardar').addClass('hidden');
        $('.btnActualizar').removeClass('hidden');
        var idCliente = $(this).attr("idCliente");
        
        var datos = new FormData();
        datos.append("idCliente", idCliente);

        $.ajax({
            url: "ajax/cliente.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                $('#idCliente').val(respuesta['id']);
                $('#nuevoTipoContri').val(respuesta['u_tipcont']);
                $('#nuevoTipoIdent').val(respuesta['u_crid']);
                $('#nuevoRuc').val(respuesta['lictradnum']);
                $('#nuevoRazonSocial').val(respuesta['cardname']);
                $('#nuevoSituacion').val(respuesta['u_crsi']);
                $('#nuevoEmail').val(respuesta['e_mail']);
                $('#nuevoTelefono').val(respuesta['phone']);
                $('#nuevoIdDireccion').val(respuesta['address']);
                $('#nuevoCalle').val(respuesta['Street']); 
                $('#nuevoTipoDireccion').val(respuesta['AdresType']); 
                $('#nuevoNroCasa').val(respuesta['StreetNo']);
                $(".alert").remove();
                $("#nuevoDistrito").prop('disabled', false);
                $("#nuevoBarrio").prop('disabled', false);
            }
        });
    });

    $("#nuevoDepartamento").change(function(){
        $("#nuevoDistrito").prop('disabled', false);
        var idDepartamento = $("#nuevoDepartamento").val();
        var datos = new FormData();
        datos.append("idDepartamento", idDepartamento);
        $.ajax({
            url:"ajax/cliente.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                const selectElement = document.getElementById('nuevoDistrito');

                // Eliminar el contenido anterior del select
                selectElement.innerHTML = '';

                // Agregar la opción predeterminada
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Seleccione una opción...';
                selectElement.appendChild(defaultOption);

                respuesta.forEach((item) => {
                    const option = document.createElement('option');
                    option.value = item.id_sap; // El valor del option será el 'id'
                    option.text = item.distrito; // El texto visible del option será el 'distrito'
                    selectElement.appendChild(option);
                });

            }
        });
    });


    $("#nuevoDistrito").change(function(){
        $("#nuevoBarrio").prop('disabled', false);
        var idDistrito = $("#nuevoDistrito").val();        
        var datos = new FormData();
        datos.append("idDistrito", idDistrito);
        $.ajax({
            url:"ajax/cliente.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                console.log(respuesta);

                const selectElement = document.getElementById('nuevoBarrio');

                // Eliminar el contenido anterior del select
                selectElement.innerHTML = '';

                // Agregar la opción predeterminada
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Seleccione una opción...';
                selectElement.appendChild(defaultOption);

                respuesta.forEach((item) => {
                    const option = document.createElement('option');
                    option.value = item.id_sap; // El valor del option será el 'id'
                    option.text = item.barrio; // El texto visible del option será el 'barrio'
                    selectElement.appendChild(option);
                });

            }
        });
    });

    $(window).on('load', function () {
        setTimeout(function () {
        $(".loader-page").css({visibility:"hidden",opacity:"0"})
        }, 2000);
    });


    


});

function validateInput(input) {
    // Eliminamos cualquier carácter que no sea un número o un signo de menos
    input.value = input.value.replace(/[^0-9-]/g, '');

    // Verificamos si hay más de un signo de menos
    if (input.value.indexOf('-') !== input.value.lastIndexOf('-')) {
        input.value = input.value.slice(0, input.value.lastIndexOf('-'));
    }

     // Limitamos el tamaño máximo a 12 caracteres
     if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }
}


function validateInputTelefono(input) {
    // Eliminamos cualquier carácter que no sea un número o un signo de menos
    input.value = input.value.replace(/[^0-9+]|(?<!^)\+/g, '');
     // Limitamos el tamaño máximo a 12 caracteres
     if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
    }
}