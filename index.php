

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width initial-scale=1 shrink-to-fit=no" />

        <meta name="description" content="" />

        <meta name="author" content="" />

        <title>Gallo SRL</title>

        <!-- Favicon-->

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> 

        <!-- Font Awesome icons (free version)-->

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />

        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

        <!-- Core theme CSS (includes Bootstrap)-->

        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>

        <link rel="stylesheet" href="slick/slick-theme.css">

        

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ApZ2ZkO2xhKHhwDVWT3ojyg2ktUJom3l_xQoZYXzwFPWbwddYOqFx6DFZgoFHPyF" async defer></script>

    <script type="text/javascript" >

        function GetMap()

        {

            var map = new Microsoft.Maps.Map("#map");



            // Verificar si Microsoft.Maps.Pushpin está definido

            if (typeof Microsoft.Maps.Pushpin === 'function') {

                agregarMarcadoresPersonalizados(map);

            } else {

                console.log('La biblioteca Microsoft.Maps.Pushpin no se ha cargado correctamente.');

            }

            //Add your post map load code here.

            // Función para agregar marcadores personalizados

            function agregarMarcadoresPersonalizados(map) {

                // Array de ubicaciones de marcadores

                // Array de ubicaciones de marcadores

                var ubicaciones = [

                    { latitud: -25.378327826336808, longitud: -57.47529572529363, titulo: 'GALLO - CASA MATRIZ', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 579 948<br>Cel: (0981) 226 770' },

                    { latitud: -25.317545117209153, longitud: -57.55806697508716, titulo: 'GALLO - SUC. MADAME LYNCH', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 503 802<br>Cel: (0985) 520 000' },

                    { latitud: -25.193496247985284, longitud: -57.507286893125446, titulo: 'GALLO - SUC. MARIANO ROQUE ALONSO', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 764 617<br>Cel: (0982) 509 998' },

                    { latitud: -25.370495297717092, longitud: -57.56010162805748, titulo: 'GALLO - SUC. ACCESO SUR', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 964 205<br>Cel: (0981) 111 447' },

                    { latitud: -25.280546012771342, longitud: -57.47205262965419, titulo: 'GALLO - SUC. LUQUE', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 640 201-2<br>Cel: (0981) 585 021' },

                    { latitud: -25.311575594921525, longitud: -57.613085634542365, titulo: 'GALLO - SUC. ASUNCIÓN', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 200 804-5<br>Cel: (0983) 414 346' },

                    { latitud: -25.374293958107497, longitud: -57.40976286726209, titulo: 'GALLO - SUC. RUTA 2', icono: 'assets/favicon.ico', descripcion: 'Tel: (0228) 631 901-2<br>Cel: (0985) 553 395' },
                    
                    { latitud: -25.494716716793405, longitud: -54.707898917007874, titulo: 'GALLO - SUC. CDE', icono: 'assets/favicon.ico', descripcion: 'Tel: (061) 570 074-75<br>Cel: (0982) 680 560' },
                    
                    { latitud: -25.23580360844154, longitud: -57.44869970508888, titulo: 'GALLO - SUC. LUQUE - SAN BERNARDINO', icono: 'assets/favicon.ico', descripcion: 'Tel: (021) 648 032-3<br>Cel: (0983) 113 515' },
                    
                    { latitud: -25.331113, longitud: -57.510288, titulo: 'GALLO - SUC. SAN LORENZO', icono: 'assets/favicon.ico', descripcion: 'Cel: (0987) 104 100<br>Cel: (0987) 104 700' },
                    // Agrega más ubicaciones de marcadores según sea necesario

                    

                    

                ];



                ubicaciones.forEach(function (ubicacion) {

                    var ubicacionMarcador = new Microsoft.Maps.Location(ubicacion.latitud, ubicacion.longitud);

                    var marcadorPersonalizado = new Microsoft.Maps.Pushpin(ubicacionMarcador, {

                        icon: ubicacion.icono

                    });

                    // Agrega un controlador de eventos para el clic en el marcador

                    Microsoft.Maps.Events.addHandler(marcadorPersonalizado, 'click', function (e) {

                        // Crea un infobox con el título del marcador

                        var infobox = new Microsoft.Maps.Infobox(e.target.getLocation(), {

                            title: ubicacion.titulo,

                            description: ubicacion.descripcion, // Puedes agregar una descripción si lo deseas

                            visible: false

                        });



                        // Abre el infobox

                        infobox.setOptions({ visible: true });



                        // Asocia el infobox con el mapa

                        infobox.setMap(map);

                    });



                    map.entities.push(marcadorPersonalizado);

                });

                // Ajusta la vista del mapa para abarcar todas las ubicaciones de marcadores

                var ubicacionesCoordenadas = ubicaciones.map(function (ubicacion) {

                    return new Microsoft.Maps.Location(ubicacion.latitud, ubicacion.longitud);

                });



                map.setView({

                    center: Microsoft.Maps.LocationRect.fromLocations(ubicacionesCoordenadas).center,

                    //zoom: 11.25 // Ajusta el nivel de zoom según sea necesario

                    zoom: 8.4 // Ajusta el nivel de zoom según sea necesario para CDE

                });

            }



            Microsoft.Maps.loadModule('Microsoft.Maps.Map', { callback: agregarMarcadoresPersonalizados });

        }

    </script>



        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>

            async function getIpClient() {

                try {

                    const response = await axios.get('https://api.ipify.org?format=json');

                    let ip = response.data['ip'];

                    if (ip == '138.186.60.117'){

                        $('#intranet').css('display','block');

                    } else{

                        $('#intranet').css('display','none');

                    }

                } catch (error) {

                    console.error(error);

                }

            }

        </script>

        <script>

            getIpClient();

        </script>

        <!-- Google tag (gtag.js) -->

        <script async src="https://www.googletagmanager.com/gtag/js?id=G-QK1MH9XYXE"></script>

        <script>

            window.dataLayer = window.dataLayer || [];

            function gtag(){dataLayer.push(arguments);}

            gtag('js', new Date());



            gtag('config', 'G-QK1MH9XYXE');

        </script>



    </head>

    <body id="page-top">

                <div class="loader-page">

            <img src="assets/logo-cargando.png" alt="">

        </div>

        

        <a tabindex="0" role="button" id="float" class="float animate__animated" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="left" data-bs-html="true" 

        data-bs-content='

            <div class="container">

                <div id="zoom" class="zoom text-gallo">

                    <span class="h6">Comuníquese con la sucursal mas cercana.</span>

                </div>

                <div class="row mt-2">

                    <div class="col-10">

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595986466601&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Casa Matriz</a>                        

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595985520000&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 1 - Madame Lynch</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595982509998&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 2 - Mariano R. Alonso</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595981111447&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 3 - Acceso Sur</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595981585021&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 4 - Luque</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595983414346&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 5 - Asuncion</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595985553395&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 6 - Capiata Ruta 2</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595982680560&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 7 - Ciudad del Este</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595983113515&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 8 - Luque - San Bernardino</a>

                        <a class="nav-link buttom" href="https://api.whatsapp.com/send?phone=+595987104100&text=Hola Gallo SRL, te contacto desde la web, quisiera mas información de... " target="_blank"><i class="fa-solid fa-caret-right ml-3 mr-4 text-gallo"></i> Suc. 9 - San Lorenzo</a>
                    </div>

                </div>

            </div>' data-bs-custom-class="fade"

            target="_blank">

            <i class="fab fa-whatsapp my-float"></i>

        </a>

        <div id="inicio">

            <div class="slider-frame">

                <!-- Navigation-->

                <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">

                    <div class="container">

                        <a class="navbar-brand" href="#page-top"><img id="logo" src="https://www.gallosrl.com.py/assets/img/navbar-logo.png" alt="..." class="animate__animated animate__heartBeat"/></a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

                            Menu

                            <i class="fas fa-bars ms-1"></i>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarResponsive">

                            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">

                                <li class="nav-item"><a class="nav-link active" href="#inicio">Inicio</a></li>

                                <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>

                                <li class="nav-item"><a class="nav-link" href="#productos">Productos</a></li>

                                <li class="nav-item"><a class="nav-link" href="#preguntas">Preguntas Frecuentes</a></li>

                                <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>

                                <li id="trabajaNosotros" class="nav-item"><a class="nav-link" href="TrabajaConNosotros.php">Trabaja con Nosotros</a></li>

                                <li id="intranet" class="nav-item"><a class="nav-link" href="https://www.gallosrl.com.py/G_PANEL/" target="_blank">Intranet</a></li>

                            </ul>

                        </div>

                    </div>

                </nav>

                <div class="video">

                    <video class="video1" src="assets/img/Inicio/proyectogallo/proyectogallo.mp4" autoplay loop muted></video>

                </div>

            </div>   

        </div>       

        <!-- SECCION NOSOTROS-->

        <section class="page-section" id="nosotros">

            <div class="container">

                <div class="text-center animado">

                    <h2 class="section-heading text-uppercase">Nosotros</h2>

                    <h3 class="section-subheading text-muted"></h3>

                </div>

                <ul class="timeline animado">

                    <li>

                        <div class="timeline-image bg-white"><img class="rounded-circle img-fluid" src="assets/img/nosotros/mision.png" alt="..." /></div>

                        <div class="timeline-panel">

                            <div class="timeline-heading">

                                <h4 class="subheading">MISIÓN</h4>

                            </div>

                            <div class="timeline-body">

                                <p class="text-muted">Proveer acero de alta calidad para la construcción, 

                                    promoviendo su importancia con la seriedad que conllevan los mismos en las construcciones 

                                    civiles y metalmecánicas, entendiendo las funciones estructurales que cumplen y 

                                    las necesidades de los consumidores a profundidad.</p>

                            </div>

                        </div>

                    </li>

                    <li class="timeline-inverted">

                        <div class="timeline-image bg-white"><img class="rounded-circle img-fluid" src="assets/img/nosotros/Vision.png" alt="..." /></div>

                        <div class="timeline-panel">

                            <div class="timeline-heading">

                                <h4 class="subheading">VISIÓN</h4>

                            </div>

                            <div class="timeline-body">

                                <p class="text-muted">Ser el principal referente de acero para la construcción civil y 

                                    metalmecánica del país, no solo en la fabricación y ventas, 

                                    sino también en la asesoría de proyectos que impliquen su uso.</p>

                            </div>

                        </div>

                    </li>

                    <li>

                        <div class="timeline-image bg-white"><img class="rounded-circle img-fluid" src="assets/img/nosotros/politica.png" alt="..." /></div>

                        <div class="timeline-panel">

                            <div class="timeline-heading">

                                <h4 class="subheading">POLÍTICA DE CALIDAD</h4>

                            </div>

                            <div class="timeline-body">

                                <p class="text-muted">En Gallo S.R.L. estamos comprometidos a brindarles nuestros productos a 

                                    los clientes cumpliendo con las normativas y requisitos necesarios, utilizando tecnología 

                                    apropiada con personal calificado, para mantener la satisfacción de los mismos procesando 

                                    materia prima de calidad y mejorando continuamente los procesos.</p>

                            </div>

                        </div>

                    </li>

                    <li class="timeline-inverted">

                        <div class="timeline-image bg-white"><img class="rounded-circle img-fluid" src="assets/img/nosotros/objetivos.png" alt="..." /></div>

                        <div class="timeline-panel">

                            <div class="timeline-heading">

                                <h4 class="subheading">OBJETIVOS DE CALIDAD</h4>

                            </div>

                            <div class="timeline-body">

                                <p class="text-muted">

                                    • Mantener la satisfacción de nuestros clientes. <br>

                                    • Obtener y mantener la marca ONC.

                                </p>

                                <img class="img-150 mt-1" src="assets/onc.png" alt="">

                            </div>

                        </div>

                    </li>

                    <li class="timeline-inverted">

                        <div class="timeline-image" style="background-color: #DE6262!important;">

                            <h4>

                                ¡Se Parte

                                <br />

                                de Nuestra

                                <br />

                                Historia!

                            </h4>

                        </div>

                    </li>

                </ul>

            </div>

        </section>

        <!-- SECCION PRODUCTOS -->

        <section class="page-section" id="productos" style="padding-top: 10px;">

            <div class="container">

                <div class="text-center animado pb-0">

                    <h2 class="section-heading text-uppercase">CONOCÉ NUESTROS <span class="text-gallo">PRODUCTOS</span></h2>

                    <h3 class="section-subheading text-muted">Acero de alta calidad para la construcción.</h3>

                </div>

                <div class="animado">

                    <div class="container">

                        <section id="slider">

                            <input class="input" type="radio" name="slider" id="s1" checked>

                            <input class="input" type="radio" name="slider" id="s2">

                            <input class="input" type="radio" name="slider" id="s3">

                            <input class="input" type="radio" name="slider" id="s4">

                            <input class="input" type="radio" name="slider" id="s5">

                            <input class="input" type="radio" name="slider" id="s6">

                            <input class="input" type="radio" name="slider" id="s7">

                            <input class="input" type="radio" name="slider" id="s8">

                            <input class="input" type="radio" name="slider" id="s9">

                            <label for="s1" id="slide1">

                                <img id="foto1" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo1" class="p1"></p>

                                    <p id="titulo11" class="p2"></p>

                                </div>

                            </label>

                            <label for="s2" id="slide2">

                                <img id="foto2" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo2" class="p1"></p>

                                    <p id="titulo22" class="p2"></p>

                                </div>

                            </label>

                            <label for="s3" id="slide3">

                                <img id="foto3" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo3" class="p1"></p>

                                    <p id="titulo33" class="p2"></p>

                                </div>

                            </label>

                            <label for="s4" id="slide4">

                                <img id="foto4" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo4" class="p1"></p>

                                    <p id="titulo44" class="p2"></p>

                                </div>

                            </label>

                            <label for="s5" id="slide5">

                                <img id="foto5" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo5" class="p1"></p>

                                    <p id="titulo55" class="p2"></p>

                                </div>

                            </label>

                            <label for="s6" id="slide6">

                                <img id="foto6" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo6" class="p1"></p>

                                    <p id="titulo66" class="p2"></p>

                                </div>

                            </label>

                            <label for="s7" id="slide7">

                                <img id="foto7" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo7" class="p1"></p>

                                    <p id="titulo77" class="p2"></p>

                                </div>

                            </label>

                            <label for="s8" id="slide8">

                                <img id="foto8" alt="">

                                <div id="info" class="info-sm">

                                    <p id="titulo8" class="p1"></p>

                                    <p id="titulo88" class="p2"></p>

                                </div>

                            </label>

                            <label for="s9" id="slide9">

                                <img src="assets/img/portfolio/otros/otros.jpg" alt="">

                                <div id="info" class="info-sm">

                                    <p class="p1">OTROS PRODUCTOS <span class="btn btn-gallo btn-sm float-end" data-bs-target="#portfolioModal9" data-bs-toggle="modal">Ver Mas</span></p>

                                    <p class="p2">OTROS PRODUCTOS <span class="btn btn-gallo btn-xs float-end" data-bs-target="#portfolioModal9" data-bs-toggle="modal">Ver Mas</span></p>

                                </div>

                            </label>

                        </section>

                    </div>

                </div>

            </div>

            <!--<div class="py-1 animado" style="background: #eaeffac4;">

                <div class="container">

                    <div class="row align-items-center col-12 text-center">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/logo-aza.png" alt="..." aria-label="AZA">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/yguazu-cemento.png" alt="..." aria-label="YGUAZU">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/logo-inc.png" alt="..." aria-label="INC">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/Logo_Sika_AG.svg.png" alt="..." aria-label="SIKA">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/cecon-logo-light.png" alt="..." aria-label="CECON">

                        <img class="img-logo-auspiciantes" src="assets/img/logos/ibex.svg" alt="..." aria-label="CECON">

                    </div>

                </div>

            </div>-->

        </section>     

        <!-- SECCION PREGUNTAS -->

        <section class="page-section" id="preguntas">

            <div class="container">

                <div class="text-center animado">

                    <h2 class="section-heading text-uppercase">Preguntas Frecuentes</h2>

                    <h3 class="section-subheading text-muted"></h3>

                </div>

                <div class="row text-center">

                    <div class="col-md-3 animado">

                        <span class="fa-stack fa-4x">

                            <i class="fas fa-circle fa-stack-2x text-gallo"></i>

                            <i class="fas fa-address-book fa-stack-1x fa-inverse"></i>

                        </span>

                        <h5 class="my-3">¿Cómo puedo ponerme en contacto con Gallo S.R.L.?</h5>

                        <p class="text-muted">Pueden llamarnos cuando guste al (021) 579-948/9 - (0981) 226-770, escribirnos un mail a gallosrl@gallosrl.com.py o completar el formulario al final de la página y nosotros lo contactamos.</p>

                    </div>

                    <div class="col-md-3 animado">

                        <span class="fa-stack fa-4x">

                            <i class="fas fa-circle fa-stack-2x text-gallo"></i>

                            <i class=" fas fa-headset fa-stack-1x fa-inverse"></i>

                        </span>

                        <h5 class="my-3">¿Cuál es el horario de atención?</h5>

                        <p class="text-muted">Los esperamos de Lunes a Viernes de 06:45 a 17:00 hs. y los días Sábados de 06:45 a 12:00 hs.</p>

                    </div>

                    <div class="col-md-3 animado">

                        <span class="fa-stack fa-4x">

                            <i class="fas fa-circle fa-stack-2x text-gallo"></i>

                            <i class="fas fa-truck-moving fa-stack-1x fa-inverse"></i>

                        </span>

                        <h5 class="my-3">¿En cuánto tiempo voy a recibir mi pedido?</h5>

                        <p class="text-muted">Los pedidos en la zona de Asunción y Gran Asunción se entregan a la dirección que usted nos indique a más tardar en 24 horas.</p>

                    </div>

                    <div class="col-md-3 animado">

                        <span class="fa-stack fa-4x">

                            <i class="fas fa-circle fa-stack-2x text-gallo"></i>

                            <i class="fas fa-hand-holding-usd fa-stack-1x fa-inverse"></i>

                        </span>

                        <h5 class="my-3">¿Cuál es el monto mínimo para que el pedido pueda ser entregado en mi obra?</h5>

                        <p class="text-muted">El monto mínimo de pedido debe ser de Gs. 2.500.000.</p>

                    </div>

                </div>

            </div>

        </section>

        <!-- SECCION CONTACTO-->

        <section class="page-section" id="contacto" style="padding-top: 20px;">

            <div class="container">

                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto img-logos">

                        <h2 class="text-center mb-4 text-white animado">CONTACTO</h2>



                        <nav class="d-flex justify-content-center animado">

                            <div class="nav nav-tabletas align-items-baseline justify-content-center" id="nav-tab"

                                role="tablist">

                                <button class="nav-link active button mb-1" id="nav-ContactForm-tab" data-bs-toggle="tab"

                                    data-bs-target="#nav-ContactForm" type="button" role="tab"

                                    aria-controls="nav-ContactForm" aria-selected="true">

                                    <h5>Contacto</h5>

                                </button>



                                <button class="nav-link button btnVerGoogleMaps" id="nav-ContactMap-tab" data-bs-toggle="tab"

                                    data-bs-target="#nav-ContactMap" type="button" role="tab"

                                    aria-controls="nav-ContactMap" aria-selected="false">

                                    <h5>Ver Mapa</h5>

                                </button>

                            </div>

                        </nav>



                        <div class="tableta-content shadow-lg mt-5 animado" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-ContactForm" role="tabpanel"

                                aria-labelledby="nav-ContactForm-tab" tabindex="0">

                                <form  id="contactoForm" method="post" role="form">

                                    <div class="row align-items-stretch mb-5">

                                        <div class="col-md-12">

                                            <div class="form-group m-2">

                                                <!-- Name input-->

                                                <input class="form-control" id="name" name="name" type="text" placeholder="Nombre *" autocomplete="off" data-sb-validations="required" />

                                                <div class="invalid-feedback" data-sb-feedback="name:required">El Nombre es Obligatorio.</div>

                                            </div>

                                            <div class="form-group m-2">

                                                <!-- Email address input-->

                                                <input class="form-control" id="email" name="email" type="email" placeholder="Email *" autocomplete="off" data-sb-validations="required,email" />

                                                <div class="invalid-feedback" data-sb-feedback="email:required">El Email es Obligarotio.</div>

                                                <div class="invalid-feedback" data-sb-feedback="email:email">El Email no es Valido.</div>

                                            </div>

                                            <div class="form-group  m-2">

                                                <!-- Phone number input-->

                                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="Telefono *" autocomplete="off" data-sb-validations="required" />

                                                <div class="invalid-feedback" data-sb-feedback="phone:required">El Telefono es Obligatorio.</div>

                                            </div>

                                            <div class="form-group m-2">

                                                <!-- Message input-->

                                                <textarea class="form-control" rows="4" id="message" name="message" placeholder="Mensaje *" autocomplete="off" data-sb-validations="required"></textarea>

                                                <div class="invalid-feedback" data-sb-feedback="message:required">El Mensaje es Obigatorio.</div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-xl-6 col-lg-5 col-md-3 col-sm-8"></div>

                                        <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10 col-xs-12 float-end mb-3">

                                            <div class="g-recaptcha" id="captcha" data-sitekey="6LcQilwmAAAAAB_Vse67owYFV6e5KZTs0kKQs4ky"></div>

                                        </div>

                                    </div>

                                    <div class="text-center">

                                        <input class="btn btn-gallo btn-xl text-uppercase" id="submitButton" type="submit" value="Enviar Mensaje">

                                        <button class="btn btn-gallo btn-xl text-uppercase hidden" id="enviando" type="button" disabled>

                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando Mensaje...

                                        </button>

                                        <button class="btn btn-gallo btn-xl text-uppercase hidden" id="enviado" type="button" disabled>

                                            <i class="fa fa-check"></i> Enviado

                                        </button>

                                    </div>

                                </form>

                            </div>



                            <div class="tab-pane fade" id="nav-ContactMap" role="tabpanel"

                                aria-labelledby="nav-ContactMap-tab" tabindex="0">

                                <div class="google-maps" id="map"></div>

                            </div>

                        </div>

                    </div>



                </div>

            </div>

        </section>

        <section class="footer py-4">

            <div class="container-fluid">

                <div class="row animado">

                    <div class="responsive">

                        <table id="tabla" class="tabla responsive" width="100%">

                            <thead class="thead">

                                <tr class="tr">

                                    <th class="text-center col-4 th">

                                        <h4 class="title">LOCALES</h4>

                                        <br>

                                    </th>

                                    <th class="th text-center col-4">

                                        <h4 class="title">TELÉFONOS</h4>

                                        <br>

                                    </th>

                                    <th class="th text-center col-4">

                                        <h4 class="title">EMAIL</h4>

                                        <br>

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="tbody">

                                <tr class="tr">

                                    <td class="td text-center">

                                        Casa Matriz - Ruta D027 (Ex Ruta Nro 1) C/ Adán Ramírez - Capiatá

                                    </td>

                                    <td class="td text-center">

                                        (021) 579 948 / (0981) 226 770

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:gallosrl@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">gallosrl@gallosrl.com.py</a>

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 1 - Avda. Madame Lynch c/ Leonismo Fernandino y Rio Yhaguy - FDM

                                    </td>

                                    <td class="td text-center">

                                        (021) 503 802 / (0985) 520 000 / (0986) 904 201

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:encargados.mlynch@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">encargados.mlynch@gallosrl.com.py</a>   

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 2 - Ruta PY 03 Gral. Elizardo Aquino c/ Charrúa - Mariano Roque Alonso

                                    </td>

                                    <td class="td text-center">

                                        (021) 764 617 / (0985) 420 039

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:encargados.mra@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">encargados.mra@gallosrl.com.py</a>

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 3 - Ruta PY 01 Mcal. Francisco S. López c/ Mauricio Cardozo Ocampo - Ñemby

                                    </td>

                                    <td class="td text-center">

                                        (021) 964 205 / (0981) 111 017 / (0981) 111 447

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:ventas1.accesosur@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">ventas1.accesosur@gallosrl.com.py</a>

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 4 - Ruta D023 Avda. Las Residentas c/ Fidelina Vda. De Sotelo - Luque

                                    </td>

                                    <td class="td text-center">

                                        (021) 640 201-2 / (0981) 585 098 / (0981) 585 021

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:encargados.luque@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">encargados.luque@gallosrl.com.py</a>                                        

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 5 - Avda. Dr. Fdo. De La Mora e/ Padre Rafael Elizeche - Asunción

                                    </td>

                                    <td class="td text-center">

                                        (021) 200 804-5 /  (0983) 410 279 / (0983) 414 346

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:deisy.castillo@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">deisy.castillo@gallosrl.com.py</a>

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 6 - Ruta PY 02 Mcal. José Félix Estigarribia c/ Luis Fustagno - Capiatá

                                    </td>

                                    <td class="td text-center">

                                        (0228) 631 901-2 / (0985) 559 595 / (0985) 553 395

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:ventas1.ruta2@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">ventas1.ruta2@gallosrl.com.py</a>   

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 7 - Ruta PY 02 Mcal. José Félix Estigarribia Km 11 lado Monday - Ciudad del Este

                                    </td>

                                    <td class="td text-center">

                                        (061) 570 074-075 / (0982) 680 560 / (0982) 670 166 

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:encargados.cde@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">encargados.cde@gallosrl.com.py</a>   

                                    </td>

                                </tr>

                                <tr class="tr">

                                    <td class="td text-center">

                                        Suc. 8 - Ruta D012 Ruta Luque - San Bernardino esq. Florencio Espínola - Luque

                                    </td>

                                    <td class="td text-center">

                                        (021) 648 032-3 / (0983) 113 515 / (0983) 114 072 

                                    </td>

                                    <td class="td text-center">

                                        <a class="a-link" href="mailto:ventas1.luquesanber@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"

                                        data-bs-custom-class="custom-tooltip"

                                        data-bs-title="Envianos un correo dando click aquí.">ventas1.luquesanber@gallosrl.com.py</a>   

                                    </td>

                                </tr>

                                <tr class="tr">
                                    <td class="td text-center">
                                        Suc. 9 - Av. Gral. Eugenio A. Garay C/ Dr. Ramon Frizzola  - San Lorenzo
                                    </td>
                                    <td class="td text-center">
                                        (0987) 104 100 / (0987) 104 700 
                                    </td>
                                    <td class="td text-center">
                                        <a class="a-link" href="mailto:ventas1.luquesanber@gallosrl.com.py" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Envianos un correo dando click aquí.">ventas1.sanlorenzo@gallosrl.com.py</a>   
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

        <!-- Footer-->

        <footer class="footer py-4 animado" style="background: rgba(170, 170, 170, 0.5);">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-12 my-3 my-lg-0">

                        <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/AcerosGalloPy/?locale=es_LA" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>

                        <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/acerosgallopy/?hl=es" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>

                        <div class="col-lg-12 text-lg-center"><br> Copyright &copy; Desarrollado por <strong><span class="desarrollado"></span></strong></div>

                    </div>

                </div>

            </div>

        </footer>

        <!-- Portfolio Modals 1-->

        <div class="modal fade" id="portfolioModal1" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal1" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg9" class="producto-gallo foto1" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal1" class="text-justify"></p>

                                    

                                </div>

                            </div>

                            <div>

                                <p class="justify">

                                    El proceso de laminación Gallo permite reducir levemente el peso en las barras, para igualar barra por barra a las varillas conformadas para construcción de menor límite de frecuencia (420/500 MPa), manteniendo la misma resistencia estructural del Hormigón Armado (H°A°) sin necesidad de modificar las dimensiones de los elementos, basados en que soportan la <strong>misma carga de fluencia.</strong>

                                </p>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th class="text-center">Producto Gallo 6000</th>

                                          <th class="text-center">Diametro Nominal (mm)</th>

                                          <th class="text-center">Fluencia MPA</th>

                                            <th class="text-center">Resistencia MPa</th>

                                          <th class="text-center">Alargamiento %</th>

                                          <th class="text-center">Pino de Doblado mm</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>6S</td>

                                          <td>5,20</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>6A</td>

                                          <td>5,70</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>8S</td>

                                          <td>7,10</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>8A</td>

                                          <td>7,60</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>10S</td>

                                          <td>9,00</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>10A</td>

                                          <td>9,50</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>12S</td>

                                          <td>11,00</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                          <td>12A</td>

                                          <td>11,30</td>

                                          <td>600</td>

                                            <td>1,05 x Fluencia</td>

                                          <td>5</td>

                                          <td>5d</td>

                                        </tr>

                                        <tr>

                                            <td colspan="25%">

                                                Obs.: Otros diametros equivalentes, favor consultar | Pueden ser proveídos también en rollos de hasta 1500kg.

                                            </td>

                                        </tr>

                                      </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="col-lg-12">

                            <div class="row mt-5">

                                <div class="col-md-7 col-sm-12 col-xs-12">

                                    <center>

                                        <h3>EQUIVALENCIA DE LAS BARRAS CONFORMADAS</h2>

                                    </center>

                                    <div class="table-responsive">

                                        <table class="table table-striped table-condensed">

                                            <thead>

                                                <tr>

                                                  <th class="text-center">Producto Gallo 6000</th>

                                                  <th class="text-center">Diametro Nominal (mm)</th>

                                                  <th class="text-center">Conf. Lam. Caliente mm</th>

                                                  <th class="text-center">Equivalencia MPa</th>

                                                </tr>

                                              </thead>

                                              <tbody>

                                                <tr>

                                                  <td>6S</td>

                                                  <td>5,20</td>

                                                  <td>6,00</td>

                                                  <td>420</td>

                                                </tr>

                                                <tr>

                                                  <td>6A</td>

                                                  <td>5,70</td>

                                                  <td>6,00</td>

                                                  <td>500</td>

                                                </tr>

                                                <tr>

                                                  <td>8S</td>

                                                  <td>7,10</td>

                                                  <td>8,00</td>

                                                  <td>420</td>

                                                </tr>

                                                <tr>

                                                  <td>8A</td>

                                                  <td>7,60</td>

                                                  <td>8,00</td>

                                                  <td>500</td>

                                                </tr>

                                                <tr>

                                                  <td>10S</td>

                                                  <td>9,00</td>

                                                  <td>10,00</td>

                                                  <td>420</td>

                                                </tr>

                                                <tr>

                                                  <td>10A</td>

                                                  <td>9,50</td>

                                                  <td>10,00</td>

                                                  <td>500</td>

                                                </tr>

                                                <tr>

                                                  <td>12S</td>

                                                  <td>11,00</td>

                                                  <td>12,00</td>

                                                  <td>420</td>

                                                </tr>

                                                <tr>

                                                  <td>12A</td>

                                                  <td>11,30</td>

                                                  <td>12,00</td>

                                                  <td>500</td>

                                                </tr>

                                              </tbody>

                                        </table>

                                    </div>

                                    <h3 class="text-center mt-4 mb-3">Ventajas de las Barras de Acero Gallo 6000</h3>

                                    <div class="items">

                                        <ul><i class="fa fa-caret-right text-gallo text-gallo"></i> Soporta mayor carga con menos cantidad de acero</ul>

                                        <ul><i class="fa fa-caret-right text-gallo text-gallo"></i> Menor costo de transporte por mayor cantidad de unidades</ul>

                                        <ul><i class="fa fa-caret-right text-gallo text-gallo"></i> Posee mayor adherencia en el hormigón por sus nervuras en dos caras y su forma de cáscara de nuez</ul>

                                        <ul><i class="fa fa-caret-right text-gallo text-gallo"></i> Excelentes propiedades mecánicas para el doblado</ul>

                                        <ul><i class="fa fa-caret-right text-gallo text-gallo"></i> Sobresalientes condiciones de soldabilidad</ul>

                                    </div>

                                </div>

                                <div class="col-md-5 col-sm-12 col-xs-12">

                                    <img id="myImg10" src="assets/img/portfolio/otros/10.jpg" alt="" class="producto-gallo">

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 mt-5 col-sm-12 col-xs-12">

                            <h3 class="text-center" style="margin-bottom: 0px;">Usos de las barras conformadas Gallo 6000</h3>

                            <div class="items ml-3 mt-3">

                                <ul><i class="fa fa-caret-right text-gallo"></i> En armaduras de vigas, columnas, losas, fundiciones, estructuras</ul>

                                <ul><i class="fa fa-caret-right text-gallo"></i> Especiales, pavimentos</ul>

                                <ul><i class="fa fa-caret-right text-gallo"></i> Mallas electrosoldadas</ul>

                            </div>

                        </div>

                        <div class="col-md-6 mt-5 col-sm-12 col-xs-12">

                            <h3 class="text-center" style="margin-bottom: 0px;">Normas que aplica</h3>

                            <div class="items ml-3 mt-3">

                                <ul><i class="fa fa-caret-right text-gallo"></i> Norma Argentina: IRAM-IAS 500-26</ul>

                                <ul><i class="fa fa-caret-right text-gallo"></i> Norma Brasilera: ABTN - 7480</ul>

                                <ul><i class="fa fa-caret-right text-gallo"></i> Norma Paraguaya: INTN - NP 4 010 05</ul>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 2-->

        <div class="modal fade" id="portfolioModal2" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

                <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal2" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg2" class="producto-gallo foto2" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal2" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th>Producto</th>

                                          <th>Diámetro</th>

                                          <th>Presentación</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>BWG 18</td>

                                          <td>1,24 mm</td>

                                          <td>1 kg</td>

                                        </tr>

                                        <tr>

                                          <td>BWG 14</td>

                                          <td>2,11 mm</td>

                                          <td>30 kg</td>

                                        </tr>

                                        <tr>

                                          <td>BWG 9</td>

                                          <td>3.76 mm</td>

                                          <td>30 kg</td>

                                        </tr>

                                        <tr>

                                          <td class="text-left" colspan="100%">Obs.: otras medidas y presentaciones, favor consultar.</td>

                                        </tr>

                                      </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 3-->

        <div class="modal fade" id="portfolioModal3" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

                <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal3" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg3" class="producto-gallo foto3" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal3" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th>Producto</th>

                                          <th>Longitud</th>

                                          <th>Diámetro</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>2 x 11</td>

                                          <td>2"</td>

                                          <td>3,04mm</td>

                                        </tr>

                                        <tr>

                                          <td>2 1/2 x 11</td>

                                          <td>2,5"</td>

                                          <td>3,04mm</td>

                                        </tr>

                                        <tr>

                                            <td>2 x 13</td>

                                            <td>2"</td>

                                            <td>2,41mm</td>

                                          </tr>

                                      </tbody>

                                </table>

                            </div>

                            <div class="row mt-2">

                                <center>

                                    <h3 class="text-gallo"><span>PROPIEDADES</span></h2>

                                </center>

                                <div class="items">

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Alta resistencia al impacto</ul>

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Brillo característico en el producto</ul>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 4-->

        <div class="modal fade" id="portfolioModal4" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal4" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg4" class="producto-gallo foto4" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal4" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th>Producto</th>

                                          <th>Diámetro(mm)</th>

                                          <th>Presentación(m)</th>

                                          <th>Carga de Rotura(kgf)</th>

                                          <th>Distancia entre púas(")</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>BWG 16</td>

                                          <td>1,6</td>

                                          <td>400</td>

                                          <td>350</td>

                                          <td>5</td>

                                        </tr>

                                        <tr>

                                            <td>BWG 16</td>

                                            <td>1,6</td>

                                            <td>200</td>

                                            <td>350</td>

                                            <td>5</td>

                                          </tr>

                                      </tbody>

                                </table>

                            </div>

                            <div class="row mt-2">

                                <center>

                                    <h3>APLICACIONES Y <span class="text-gallo"> USOS</span></h2>

                                </center>

                                <div class="items">

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Delimitación de potreros y terrenos agrícolas. </ul>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 5-->

        <div class="modal fade" id="portfolioModal5" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal5" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg5" class="producto-gallo foto5" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal5" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th colspan="100%" class="text-center">Tipos</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>4 / 10x10 / 3x2</td>

                                          <td>5 / 10x10 / 3x2</td>

                                          <td>7 / 10x10 / 3x2</td>

                                        </tr>

                                        <tr>

                                          <td>4 / 15x15 / 3x2</td>

                                          <td>5 / 15x15 / 3x2</td>

                                          <td>7 / 15x15 / 3x2</td>

                                        </tr>

                                        <tr>

                                          <td>4 / 20x20 / 3x2</td>

                                          <td>5 / 20x20 / 3x2</td>

                                          <td>7 / 20x20 / 3x2</td>

                                        </tr>

                                        <tr>

                                          <td>4 / 15x15 / 6x2</td>

                                          <td>5 / 15x15 / 6x2</td>

                                          <td>7 / 15x15 / 6x2</td>

                                        </tr>

                                        <tr>

                                          <td>4 / 20x20 / 6x2</td>

                                          <td>5 / 20x20 / 6x2</td>

                                          <td>7 / 20x20 / 6x2</td>

                                        </tr>

                                        <tr>

                                          <td class="text-left" colspan="100%">Obs.: otros tipos favor consultar.</td>

                                        </tr>

                                      </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 6-->

        <div class="modal fade" id="portfolioModal6" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal6" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg6" class="producto-gallo foto6" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal6" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th>Producto</th>

                                          <th>Diámetro (mm)</th>

                                          <th>Presentación (m)</th>

                                          <th>Carga de Rotura (kgf)</th>

                                          <th>Capa de Zinc (gr/m2)</th>

                                        </tr>

                                      </thead>

                                      <tbody>

                                        <tr>

                                          <td>BWG 17/15</td>

                                          <td>2,5</td>

                                          <td>1000</td>

                                          <td>700</td>

                                          <td>70-90</td>

                                        </tr>

                                      </tbody>

                                </table>

                            </div>

                            <div class="row mt-2">

                                <center>

                                    <h3>APLICACIONES Y <span class="text-gallo"> USOS</span></h2>

                                </center>

                                <div class="items">

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Cierres de potreros y cultivos.</ul>

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Construcción de viveros.</ul>

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Cercos lisos y electrificados.</ul>

                                    <ul><i class="fa fa-caret-right text-gallo text-gallo text-gallo"></i> Diferentes usos industriales.</ul>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 7-->

        <div class="modal fade" id="portfolioModal7" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        

                        <h3 id="tituloModal7" class="item-intro pb-5"></h3>

                    </div>

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <img id="myImg7" class="producto-gallo foto7" alt="..." />

                        </div>

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    <p id="descripcionModal7" class="text-justify"></p>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-condensed">

                                    <thead>

                                        <tr>

                                          <th colspan="50%" class="text-center">Dimensiones de los estribos 4,2mm.</th>

                                          <th colspan="50%" class="text-center">Diámetro de las varillas.</th>

                                          </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td colspan="25%" class="text-center">Ancho</td>

                                            <td colspan="25%" class="text-center">Largo</td>

                                            <td colspan="16%" class="text-center">5,0mm</td>

                                            <td colspan="16%" class="text-center">7,0mm</td>

                                            <td colspan="16%" class="text-center">9,0mm</td>

                                        </tr>

                                        <tr>

                                             <td colspan="25%" class="text-center">7cm</td>

                                            <td colspan="25%" class="text-center">14cm</td>

                                            <td colspan="16%" class="text-center">X</td>

                                            <td colspan="16%" class="text-center">X</td>

                                            <td colspan="16%" class="text-center"></td>

                                        </tr>

                                        <tr>

                                             <td colspan="25%" class="text-center">7cm</td>

                                            <td colspan="25%" class="text-center">17cm</td>

                                            <td colspan="16%" class="text-center"></td>

                                            <td colspan="16%" class="text-center">X</td>

                                            <td colspan="16%" class="text-center"></td>

                                        </tr>

                                        <tr>

                                            <td colspan="25%" class="text-center">7cm</td>

                                            <td colspan="25%" class="text-center">20cm</td>

                                            <td colspan="16%" class="text-center"></td>

                                            <td colspan="16%" class="text-center">X</td>

                                            <td colspan="16%" class="text-center"></td>

                                        </tr>

                                        <tr>

                                            <td colspan="25%" class="text-center">7cm</td>

                                            <td colspan="25%" class="text-center">27cm</td>

                                            <td colspan="16%" class="text-center"></td>

                                            <td colspan="16%" class="text-center"></td>

                                            <td colspan="16%" class="text-center">X</td>

                                        </tr>

                                        <tr>

                                            <td colspan="100%">El largo padrón de las armaduras son de 6 m. <br>Obs: Otras medidas y presentaciones favor consultar.</td>

                                       </tr>

                                    </tbody>

                                </table>

                            </div>

                            <div class="row mt-2">

                                <center>

                                    <h3>DIMENSIONES DE LOS <span class="text-gallo"> ESTRIBOS</span></h2>

                                </center>

                                <div class="items text-center">

                                    <img id="myImg8" src="assets/img/portfolio/otros/7.1.jpg" alt="" class="img-responsive">    

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

              </div>

            </div>

        </div>

        <!-- Portfolio Modals 8-->

        <div class="modal fade" id="portfolioModal8" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

                <div class="modal-content">

                    <div class="modal-header">

                        <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <div class="text-center">

                            

                            <h3 id="tituloModal8" class="item-intro pb-5"></h3>

                        </div>

                        <div class="row" style="padding-left: 25px;">

                            <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                                <img id="myImg1" class="producto-gallo foto8" alt="..." />

                            </div>

                            <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                                <div class="card pb-0 mb-3 text-bg-secondary">

                                    <div class="card-body text-center">

                                        <p id="descripcionModal8" class="text-justify"></p>

                                    </div>

                                </div>

                                <div class="table-responsive">

                                    <table class="table table-striped table-condensed">

                                        <thead>

                                            <tr>

                                                <th>Producto</th>

                                                <th>Diámetro(mm)</th>

                                                <th>Altura(m)</th>

                                                <th>Ojo(cm)</th>

                                                <th>Largo(m)</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td>BWG 14</td>

                                                <td>2,11</td>

                                                <td>1,5</td>

                                                <td>5</td>

                                                <td>25</td>

                                            </tr>

                                            

                                            <tr>

                                                <td>BWG 14</td>

                                                <td>2,11</td>

                                                <td>1,7</td>

                                                <td>7</td>

                                                <td>25</td>

                                            </tr>

                                            <tr>

                                                <td colspan="100%">Obs: otras alturas y largos, favor consultar.</td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Portfolio Modals 9-->

        <div class="modal fade" id="portfolioModal9" tabindex="-1">

            <div class="modal-dialog modal-fullscreen">

              <div class="modal-content">

                <div class="modal-header">

                    <h3 class="text-uppercase">Conocé Nuestros <span class="text-gallo">productos</span></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="text-center">

                        <!-- Project details-->

                        <h3 class="item-intro pb-5">OTROS PRODUCTOS</h3>

                    </div>

                    

                    <div class="row" style="padding-left: 25px;">

                        <div class="col-md-7 col-lg-7 col-sm-12 pl-4">

                            <div class="card pb-0 mb-3 text-bg-secondary">

                                <div class="card-body text-center">

                                    Contamos con todos los productos que usted necesita para sus construcciones, consulte por nuestras:

                                </div>

                                <div class="card-body">

                                    <div class="items">

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Chapas onduladas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Perfiles C y U.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Planchuelas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Caños Cuadrados.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Caños Redondos.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Chapas Negra.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Chapas Onduldas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Chapas lisas galvanizadas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Varillas Lisas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Perfil C.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Perfil U.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Trelizas.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Caños rectangulares.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Electrodos.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Cemento.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Cal.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Adhesivos.</li>

                                        <li class="nav-link"><i class="fa fa-caret-right text-gallo text-gallo"></i> Articulos de Ferreteria.</li>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5 col-lg-5 col-sm-12 mb-3">

                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

                                <ol class="carousel-indicators">

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"></li>

                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8"></li>

                                </ol>

                                <div class="carousel-inner">

                                    <div class="carousel-item active p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/1.jpg" alt="1 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/2.jpg" alt="2 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/3.jpg" alt="3 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/5.jpg" alt="4 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/8.jpg" alt="5 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/9.jpg" alt="6 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/11.jpg" alt="7 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/12.jpg" alt="8 slide">

                                    </div>

                                    <div class="carousel-item p-2">

                                        <img class="d-block w-100" style="border-radius: 15px; height: 450px;" src="assets/img/portfolio/otros/otros/13.jpg" alt="9 slide">

                                    </div>

                                </div>

                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">

                                    <span class="carousel-control-prev-icon" aria-bs-hidden="true"></span>

                                    <span class="sr-only">Previous</span>

                                </a>

                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">

                                    <span class="carousel-control-next-icon" aria-bs-hidden="true"></span>

                                    <span class="sr-only">Next</span>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                </div>

                </div>

            </div>

        </div>



        <!-- Modal para visualizar Imagenes -->

        <div id="myModal" class="modal-img fade">

            <div class="modal-dialog">

                <div class="modal-content" style="background-color: rgba(0,0,0,0)!important;">

                    <div class="modal-img-header">

                        

                        <span type="button" class="close-img" data-bs-dismiss="modal" aria-label="Close"> &times;</span>

                    </div>

                    <!-- Modal Content (The Image) -->

                    <img class="modal-img-content" id="img01">

                </div>

            </div>

        </div>



        <!-- Modal para visualizar Imagenes de Aviso  -->

        <!--<div class="modal fade" id="modal-inicio" aria-hidden="true" aria-labelledby="modal-inicio" tabindex="-1">

            <div class="modal-dialog mt-1 mb-0">

                <div class="modal-content" style="width: 90%!important; margin: auto!important;">

                    <div class="modal-header p-1">

                        <p class="m-1 text-bold">Para actualizar sus datos, da un click <a class="text-danger" href="https://www.gallosrl.com.py/clientes" target="_blank">aquí</a>.</p>

                        <button type="button" class="btn-close m-1" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <img src="assets/img/Inicio/inicio.jpg" id="img-inicio" alt="">

                </div>

            </div>

        </div>-->



        <!-- Bootstrap core JS-->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>

        

        

        <script type="text/javascript" src="slick/slick.js"></script>

        <script>

            window.onload = function() {

                funcion();

                funcionImagen();

                funcionImagenModal();

                /*setTimeout(function() {

                    $('#modal-inicio').modal('show');

                }, 2800);

                setTimeout(function() {

                    $('#modal-inicio').modal('hide');

                }, 20000);*/

            };

            /*const imagen = document.querySelector("#img-inicio");

            imagen.addEventListener("click", function(e) {

                e.preventDefault();

                window.open("https://www.gallosrl.com.py/clientes/", "_blank");

                $('#modal-inicio').modal('hide');

            });*/

        </script>

        

        <!-- Core theme JS-->

        

        <script src="js/scripts.js"></script>

        <script src="js/trabaja.js"></script>

        <script src="js/custom.js"></script>       

    </body>

</html>