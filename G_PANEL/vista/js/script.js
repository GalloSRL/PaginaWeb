$(document).ready(function () {

    console.log('   *********************************************\n',

    '*                                            *\n',

    '*  Copyrigth: JuanMartinez_2023 - Gallo SRL  *\n',

    '*                                            *\n',

    '**********************************************');

    
    
    

    // Obtener el año actual
    const fecha = new Date();
    const año = fecha.getFullYear();
    $(".desarrollado").html("<strong>Dpto. TI - Gallo SRL "+año+"</strong>");

    $('#tabla').DataTable();

    $('#btnCancelar').on('click', function(){
        $('#formulario').trigger('reset');
    });

});






// var inactivityTimeout;

// document.onmousemove = function(){
//     clearTimeout(inactivityTimeout); // Reiniciar el temporizador en cada movimiento del mouse
//     inactivityTimeout = setTimeout(function() {
//         window.location.href = "dashboard";
//     }, 300000); // Redirigir a "dashboard" después de 5 minutos de inactividad
// }

// document.onkeyup = function(){
//     clearTimeout(inactivityTimeout); // Reiniciar el temporizador en cada pulsación de tecla
//     inactivityTimeout = setTimeout(function() {
//         window.location.href = "dashboard";
//     }, 300000); // Redirigir a "dashboard" después de 5 minutos de inactividad
// }




/*var n = 300;

var id = window.setInterval(function(){

    document.onmousemove = function(){

        //n= 300;

    }

    n--;



    console.log(n);

    if (n <= 1){

        location.href = "salir";

    }

},1000);*/



