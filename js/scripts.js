/*!
* Start Bootstrap - Agency v7.0.12 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 
console.log(' **********************************************\n',
        '*                                            *\n',
        '*  Copyrigth: Gallo SRL                      *\n',
        '*                                            *\n',
        '**********************************************');

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    //  Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});

window.setInterval(
    function(){
    // Sección de código para modificar el DIV
    $("#logo").removeClass("animate__heartBeat");
  }
  // Intervalo de tiempo
,7000);

// Función de javascript para ejecutar repetidamente
window.setInterval(
    function(){
    // Sección de código para modificar el DIV
    $("#logo").addClass("animate__heartBeat");
  }
  // Intervalo de tiempo
,10000);

window.setInterval(
  function(){
  // Sección de código para modificar el DIV
  $("#float").removeClass("animate__pulse");
}
// Intervalo de tiempo
,2513);

// Función de javascript para ejecutar repetidamente
window.setInterval(
  function(){
  // Sección de código para modificar el DIV
  $("#float").addClass("animate__pulse");
}
// Intervalo de tiempo
,2000);


let animado = document.querySelectorAll(".animado");
function mostrarScroll(){
  let scrolltop = document.documentElement.scrollTop;
  for ( var i=0; i < animado.length; i++ ){
    let alturaAnimado = animado[i].offsetTop;
    if (alturaAnimado - 690 < scrolltop){
      animado[i].style.opacity = 1;
      animado[i].classList.add('mostrarArriba');
    } else {
      animado[i].style.opacity = 0;
      animado[i].classList.remove('mostrarArriba');
    }
  }

}

window.addEventListener('scroll', mostrarScroll);



function validarCampos(){
  var nombre = $("#name").val();
  var telefono = $("#phone").val();
  var email = $("#email").val();
  var mensaje = $("#message").val();

  if (nombre == "" || telefono == "" || email == "" || mensaje == "") {
      return false;
  } else {
      return true;
  }
}

$('#contactoForm').on('submit', function (e) {
  e.preventDefault();
  validarCampos();
  if (validarCampos() == true) {
      var $this = $(this),
      data = $(this).serialize(),
      name = $this.find('#name'),
      email = $this.find('#email'),
      phone = $this.find('#phone'),
      message = $this.find('#message'),
      recaptcha = $this.find('#captcha'),
      submitBtn = $this.find('button, input[type="submit"]');

      $('#submitButton').addClass('hidden');
      $('#enviando').removeClass('hidden');

      //submitBtn.attr('disabled', 'disabled');

      $.ajax({

        url:"enviar.php",
        method: "POST",
        data: data,
        success: function(respuesta){

          console.log(respuesta);
          if (respuesta == 1){
            swal.fire({
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

            swal.fire({
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
            swal.fire({
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
            swal.fire({
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

$(document).ready(function () {
  $('#tabla').DataTable({
    paging: false,
    ordering: false,
    info: false,
    searching: false,
  });
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});

$(document).ready(function(){
  //Obtnemos el Año actual
  const fecha = new Date();
  const año = fecha.getFullYear();
  $(".desarrollado").html("Dpto. TI - Gallo SRL "+año);
  $('[data-bs-toggle="popover"]').popover();

  $('.carousel').carousel();  
});

$(document).ready(function(){
  // Capturamos el src de las imagenes
  $('#myImg1').on('click', function(){ 
    var img = $('#myImg1').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg2').on('click', function(){ 
    var img = $('#myImg2').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg3').on('click', function(){ 
    var img = $('#myImg3').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg4').on('click', function(){ 
    var img = $('#myImg4').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg5').on('click', function(){ 
    var img = $('#myImg5').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg6').on('click', function(){ 
    var img = $('#myImg6').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg7').on('click', function(){ 
    var img = $('#myImg7').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg8').on('click', function(){ 
    var img = $('#myImg8').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);
  });
  $('#myImg9').on('click', function(){ 
    var img = $('#myImg9').attr('src');
    $('#myModal').modal('show');
    $('#img01').attr('src', img);   
  });
  $('#myImg10').on('click', function(){ 
    var img = $('#myImg10').attr('src');
    $('#myModal').modal('show');
    var ver = $('#img01').attr('src', img); 
    console.log(ver);
  });

  $('.close-img').on('click', function(){
    $('#myModal').modal('hide');
  });
});


$(document).ready(function () {
  $('#tabla-trabajo').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
    },
    paging: false,
    ordering: false,
    info: false,  
    searching: true,
  });
});

$(window).on('load', function () {
  setTimeout(function () {
    $(".loader-page").css({visibility:"hidden",opacity:"0"})
  }, 2000);
});

