$(document).ready(function () {
    console.log('   *********************************************\n',
    '*                                            *\n',
    '*  Copyrigth: JuanMartinez_2023 - Gallo SRL  *\n',
    '*                                            *\n',
    '**********************************************');
    //Obtnemos el Año actual
    const fecha = new Date();
    const año = fecha.getFullYear();
    $(".desarrollado").html("<strong>Dpto. TI - Gallo SRL "+año+"</strong>");
    $('#tabla').DataTable();

    $('#btnCancelar').on('click', function(){
        $('#formulario').trigger('reset');
        
    });
});


document.onmousemove = function(){
    setInterval(function() {
        window.location.href = "dashboard";
      }, 300000);
}


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

