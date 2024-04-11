$(document).ready(function(){
    funcionImagen = function(){
        id = 0;
        var datos = new FormData();
            datos.append("id", id);

    
    
        $.ajax({
            url:"G_PANEL/ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

            

                //Asignar imagenes y titulo a las seccion de productos
                $("#foto1").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[0]['imagen_producto']);
                $("#titulo1").html(respuesta[0]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal1" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo11").html(respuesta[0]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal1" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto2").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[1]['imagen_producto']);
                $("#titulo2").html(respuesta[1]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal2" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo22").html(respuesta[1]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal2" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto3").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[2]['imagen_producto']);
                $("#titulo3").html(respuesta[2]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal3" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo33").html(respuesta[2]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal3" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto4").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[3]['imagen_producto']);
                $("#titulo4").html(respuesta[3]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal4" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo44").html(respuesta[3]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal4" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto5").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[4]['imagen_producto']);
                $("#titulo5").html(respuesta[4]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal5" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo55").html(respuesta[4]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal5" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto6").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[5]['imagen_producto']);
                $("#titulo6").html(respuesta[5]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal6" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo66").html(respuesta[5]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal6" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto7").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[6]['imagen_producto']);
                $("#titulo7").html(respuesta[6]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal7" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo77").html(respuesta[6]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal7" data-bs-toggle="modal">Ver Mas</span>');
                $("#foto8").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[7]['imagen_producto']);
                $("#titulo8").html(respuesta[7]['nombre_producto']+' <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal8" data-bs-toggle="modal">Ver Mas</span>');
                $("#titulo88").html(respuesta[7]['nombre_producto']+' <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal8" data-bs-toggle="modal">Ver Mas</span>');
                

            }
        });
    }

    funcionImagenModal = function(){
        id = 0;
        var datos = new FormData();
            datos.append("id", id);
    
        $.ajax({
            url:"G_PANEL/ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                
                //Asignar el nombre de productos, descripcion e imagen en el modal de cada producto.
                //Producto Item 1
                $('#tituloModal1').html(respuesta[0]['nombre_producto']);
                $(".foto1").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[0]['imagen_producto']);
                $('#descripcionModal1').html(respuesta[0]['descripcion_producto']);
                $('#tituloModal2').html(respuesta[1]['nombre_producto']);
                $(".foto2").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[1]['imagen_producto']);
                $('#descripcionModal2').html(respuesta[1]['descripcion_producto']);
                $('#tituloModal3').html(respuesta[2]['nombre_producto']);
                $(".foto3").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[2]['imagen_producto']);
                $('#descripcionModal3').html(respuesta[2]['descripcion_producto']);
                $('#tituloModal4').html(respuesta[3]['nombre_producto']);
                $(".foto4").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[3]['imagen_producto']);
                $('#descripcionModal4').html(respuesta[3]['descripcion_producto']);
                $('#tituloModal5').html(respuesta[4]['nombre_producto']);
                $(".foto5").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[4]['imagen_producto']);
                $('#descripcionModal5').html(respuesta[4]['descripcion_producto']);
                $('#tituloModal6').html(respuesta[5]['nombre_producto']);
                $(".foto6").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[5]['imagen_producto']);
                $('#descripcionModal6').html(respuesta[5]['descripcion_producto']);
                $('#tituloModal7').html(respuesta[6]['nombre_producto']);
                $(".foto7").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[6]['imagen_producto']);
                $('#descripcionModal7').html(respuesta[6]['descripcion_producto']);
                $('#tituloModal8').html(respuesta[7]['nombre_producto']);
                $(".foto8").attr('src','https://gallosrl.com.py/G_PANEL/'+respuesta[7]['imagen_producto']);
                $('#descripcionModal8').html(respuesta[7]['descripcion_producto']);
                

            }
        });
    }

    funcionPregunta = function(){
        id = 0;
        var datos = new FormData();
            datos.append("id", id);
    
        $.ajax({
            url:"G_PANEL/ajax/preguntas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                //Pregunta1
                $('#fotoPregunta1').attr('src', 'G_PANEL/'+respuesta[0]['imagen']);
                $('#Pregunta1').html(respuesta[0]['pregunta']);
                $('#Respuesta1').html(respuesta[0]['respuesta']);
                //Pregunta2
                $('#fotoPregunta2').attr('src', 'G_PANEL/'+respuesta[1]['imagen']);
                $('#Pregunta2').html(respuesta[1]['pregunta']);
                $('#Respuesta2').html(respuesta[1]['respuesta']);
                //Pregunta3
                $('#fotoPregunta3').attr('src', 'G_PANEL/'+respuesta[2]['imagen']);
                $('#Pregunta3').html(respuesta[2]['pregunta']);
                $('#Respuesta3').html(respuesta[2]['respuesta']);
                //Pregunta4
                $('#fotoPregunta4').attr('src', 'G_PANEL/'+respuesta[3]['imagen']);
                $('#Pregunta4').html(respuesta[3]['pregunta']);
                $('#Respuesta4').html(respuesta[3]['respuesta']);
            }
        });
    }
})