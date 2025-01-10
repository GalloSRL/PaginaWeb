$(document).ready(function(){
    /*=============================================
    SUBIENDO LA FOTO DEL Producto
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
    EDITAR Producto
    =============================================*/
    $(document).on("click", ".btnEditarProducto", function(){

        var idProducto = $(this).attr("idProducto");
        
        var datos = new FormData();
        datos.append("idProducto", idProducto);

        $.ajax({

            url:"ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                var descripcion1 = respuesta['descripcion_producto'];
                var descripcion2 = descripcion1.replaceAll('<br>','\n');

                $("#editarId").val(respuesta["id"]);
                $("#editarProducto").val(respuesta["nombre_producto"]);
                $("#editarProductoDescripcion").val(descripcion2);
                $("#fotoActual").val(respuesta["imagen_producto"]);
                
                if(respuesta["imagen_producto"] != ""){

                    $(".previsualizarEditar").attr("src", respuesta["imagen_producto"]);
    
                }else{
    
                    $(".previsualizarEditar").attr("src", "vista/images/productos/anonymous.jpg");
    
                }
            }
        });
    });
    /*=============================================
    ELIMINAR Producto
    =============================================*/
    $(document).on("click", ".btnEliminarProducto", function(){
        var idProducto = $(this).attr("idProducto");
        var fotoProducto = $(this).attr("fotoProducto");
        var producto = $(this).attr("producto");
        Swal.fire({
        title: '¿Está seguro de borrar el Producto?',
        html: '<div class="alert alert-danger">Tener En cuenta que debes de tener 8 Productos Registrados.</div>',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar!'
        }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=productos&idProducto="+idProducto+"&producto="+producto+"&fotoProducto="+fotoProducto;
        }
        })
    });

    //REEMPLAZAR VALORES DE ENTER EN LA DESCRIPCION DEL PRODUCTO
    //Se realiza la validacion que si se presiono la tecla enter en el textarea del formulario de registro de un producto
    const productoDescripcion = document.getElementById('nuevoProductoDescripcion');

    productoDescripcion.addEventListener('keydown', function(event) {
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

    const editarproductoDescripcion = document.getElementById('editarProductoDescripcion');

    editarproductoDescripcion.addEventListener('keydown', function(event) {
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

});