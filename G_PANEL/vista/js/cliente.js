$(document).ready(function() {
    var miTabla = $('#tablaCliente').DataTable( {
        dom: 'lfrtipB',
        buttons: [{
            //Botón para Excel
            extend: 'excel',
            footer: true,
            title: 'Clientes',
            filename: 'datos-clientes_'+ obtenerFechaActual(),

            //Aquí es donde generas el botón personalizado
            text: '<button id="exportar-btn" class="btn btn-success">Excel <i class="fas fa-file-excel"></i></button>'
        }],
    });

    // Función para ocultar/mostrar el botón de exportación
    function actualizarBotonExportacion() {
        if (miTabla.rows().count() === 0) {
        $('.buttons-excel').hide(); // Reemplaza '.buttons-excel' por el selector del botón que desees ocultar
        } else {
        $('.buttons-excel').show();
        }
    }

    // Llamar a la función al inicializar la tabla
    actualizarBotonExportacion();

    // Llamar a la función cada vez que haya un cambio en el DataTable
    miTabla.on('draw', function() {
        actualizarBotonExportacion();
    });

    function obtenerFechaActual() {
        var fecha = new Date();
        var dia = fecha.getDate().toString().padStart(2, '0');
        var mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Los meses son indexados desde 0
        var anio = fecha.getFullYear().toString();
        return anio +'-'+ mes + '-' + dia;
      }

    // Evento para escuchar cuando el botón de exportar sea clickeado
    $('#exportar-btn').on('click', function() {
        $(".loader-page").removeClass('hidden');
        // Obtén los datos visualizados en el DataTable actual
        var datosVisualizados = miTabla.rows({ 'search': 'applied' }).data();

        // Construye el arreglo de arreglos con los valores de cada fila
        var arregloDeArreglos = datosVisualizados.toArray();

        // Convierte el arreglo de arreglos en formato JSON
        var datosJSON = JSON.stringify(arregloDeArreglos);

        var cantidadArreglo = arregloDeArreglos.length;

        // Realiza la solicitud AJAX para enviar los datos a PHP
        $.ajax({
            url: 'ajax/clientes.ajax.php',
            method: 'POST',
            data: { datos: datosJSON },
            success: function(response) {

                // Maneja la respuesta del servidor si es necesario
                if (cantidadArreglo == response){
                    $(".loader-page").addClass('hidden');
                    Swal.fire({
                        title: 'EXITO...!!!',
                        text: "Se han exportado y actualizado "+response+" de "+cantidadArreglo+" de datos requeridos",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
						confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = "clientes";
                            }
                        });
                } else {
                    $(".loader-page").addClass('hidden');
                    Swal.fire({
                        title: 'AVISO...!!!',
                        text: "Se han exportado y actualizado "+response+" de "+cantidadArreglo+" de datos",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
						confirmButtonText: 'Aceptar'
                        }).then(function(result){
                            if(result.value){
                                window.location = "clientes";
                            }
                        });
                }
                
            },
        
        });
    });
});