$(document).ready(function(){
    let grafico1;
    let grafico2;
    let grafico3;
    $("#year").change(function(){
        if ($("#year").val() != ''){
            $("#mes").attr('disabled', false);
        }else{
            $("#mes").attr('disabled', true);
            $('#mes').val('');
        }
    });

    $("#contenidoReporte").addClass('hidden');
    $(".btnVisualizarReporte").on('click', function(){
        var mes = $("#mes").val();
        var year = $("#year").val();

        if(mes == '' && year == ''){
            $("#mensaje").html('<div class="m-4 alert alert-warning"><center><h3><i class="fas fa-warning"></i> Sin Datos que Mostrar<br>Favor Selecione el Año</i></center></div>');
            $("#contenidoReporte").addClass('hidden');
            $('.btnPDF').prop('disabled', true);
        } else if(mes != '' && year != '') {
            var datos = new FormData();
            datos.append("year", year);
            datos.append("mes", mes);
            $.ajax({
                url:"ajax/tickets.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    // Supongamos que el JSON devuelto por AJAX es así:
                    const dataFromAjax = respuesta;
                    // Calcular la cantidad de registros en cada estado

                    let cantiAbiertos = 0;

                    let cantiEnProceso = 0;

                    let cantiResueltos = 0;

                    

                    dataFromAjax.forEach(row => {

                        if (row.estado == 3) {

                            cantiAbiertos++;

                        } else if (row.estado == 2) {

                            cantiEnProceso++;

                        } else if (row.estado == 1) {

                            cantiResueltos++;

                        }

                    });

        

                    var total = cantiAbiertos + cantiEnProceso + cantiResueltos;

                    

                    var PorcentajeAbierto = ((cantiAbiertos / total) * 100).toFixed(0);

                    var PorcentajeEnProceso = ((cantiEnProceso / total) * 100).toFixed(0);

                    var PorcentajeResuelto = ((cantiResueltos / total) * 100).toFixed(0);

                    

                    datospie = {

                        labels: ["Abierto : "+ PorcentajeAbierto +' %', "En Proceso : "+ PorcentajeEnProceso +' %', "Resuelto : "+ PorcentajeResuelto +' %'],

                        datasets: [{

                            backgroundColor: ['rgba(239, 154, 154, 0.5)', 'rgba(241, 196, 15, 0.5)', 'rgba(0,166,149,0.5)'],

                            data: [PorcentajeAbierto,PorcentajeEnProceso,PorcentajeResuelto],

                        }]

                    }

        

                    opciones = {

                        legend: {

                            display: true,

                            position: 'bottom',

                            align: 'center',

                        },

                        plugins: {

                            datalabels: {

                                display: false,

                            },

                            aspectRatio: 12 / 6,

                            cutoutPercentage: 5,

                            layout: {

                                padding: 5

                            },

                            elements: {

                                line: {

                                    fill: false

                                },

                                point: {

                                    hoverRadius: 7,

                                    radius: 5

                                }

                            }

                        },

                        maintainAspectRatio: false,

                        responsive: true,

                    }

        

                    

        

                    if (grafico3){

                        const ctx = document.getElementById('pieEstadoTicket').getContext('2d');

                        ctx.height = 200;

                        grafico3.destroy();

                        Chart.register(ChartDataLabels);

                        grafico3 = new Chart(ctx, {

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        var imagen1 = JSON.stringify({

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        $("#total").val(total);

                        $("#imagen1").val(imagen1);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        const ctx = document.getElementById('pieEstadoTicket').getContext('2d');

                        ctx.height = 200;

                        Chart.register(ChartDataLabels);

                        grafico3 = new Chart(ctx, {

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        var imagen1 = JSON.stringify({

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        $("#total").val(total);

                        $("#imagen1").val(imagen1);

                        $('.btnPDF').prop('disabled', false);

                    }

        

                    //Grafico Bar para tickets asignado por persona

        

                    const persona = [];

                    const cantidadesAbiertos = [];

                    const cantidadesEnProceso = [];

                    const cantidadesResueltos = [];

        

                    respuesta.forEach(row => {

                        const nombre = row.asignado_a;

                        const estado = row.estado;

        

                        if (!persona.includes(nombre)) {

                            persona.push(nombre);

                            cantidadesAbiertos.push(0); // Inicializar con 0

                            cantidadesEnProceso.push(0); // Inicializar con 0

                            cantidadesResueltos.push(0); // Inicializar con 0

                        }

        

                        if (estado == 3) {

                            cantidadesAbiertos[persona.indexOf(nombre)]++;

                        } else if (estado == 2) {

                            cantidadesEnProceso[persona.indexOf(nombre)]++;

                        } else if (estado == 1) {

                            cantidadesResueltos[persona.indexOf(nombre)]++;

                        }

                    });

        

                    //Grafico para Tickets por persona asignada

                    //data

                    const data1 =   {labels: persona,

                                    datasets: [{

                                        label: 'Abiertos',

                                        data: cantidadesAbiertos,

                                        backgroundColor: [

                                        'rgba(239, 154, 154, 0.2)'

                                        ],

                                        borderColor: [

                                        'rgba(239, 154, 154, 1)'

                                        ],

                                        borderWidth: 1,

                                    },{

                                        label: 'En Proceso',

                                        data: cantidadesEnProceso,

                                        backgroundColor: [

                                            'rgba(241, 196, 15,0.2)'

                                        ],

                                        borderColor: [

                                            'rgba(241, 196, 15,1)'

                                        ],

                                        borderWidth: 1,

                                    },{

                                        label: 'Resuelto',

                                        data: cantidadesResueltos,

                                        backgroundColor: [

                                            'rgba(0,166,149,0.5)'

                                        ],

                                        borderColor: [

                                            'rgba(0,166,149,0.7)'

                                        ],

                                        borderWidth: 1,

                                    }]};

                    //config

                    const configpa = {type: 'bar',

                                    data: data1,

                                    options: {

                                        plugins: {

                                            legend: {

                                                position: 'bottom',

                                            },

                                            datalabels: { //esta es la configuración de pluggin datalabels

                                                display: true,

                                                anchor: 'center',

                                                align: 'center',

                                            },

                                            scales: {

                                                y: {

                                                    beginAtZero: true

                                                }

                                            }

                                        },

                                        responsive: true,

                                        

                                    }

                                };



                                const configpa2 = {type: 'bar',

                                data: data1,

                                options: {

                                    legend: {

                                        position: 'bottom',

                                    },

                                    responsive: true,

                                    

                                }

                            };

                    

                        

                    if (grafico1){

                        grafico1.destroy();

                        Chart.register(ChartDataLabels);

                        grafico1 = new Chart(

                            document.getElementById("barPersonaAsignada").getContext('2d'),

                            configpa

                        );

                        var imagen2 = JSON.stringify(configpa2);

                        $("#imagen2").val(imagen2);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        Chart.register(ChartDataLabels);

                        grafico1 = new Chart(

                            document.getElementById("barPersonaAsignada").getContext('2d'),

                            configpa

                        );

                        var imagen2 = JSON.stringify(configpa2);

                        $("#imagen2").val(imagen2);

                        $('.btnPDF').prop('disabled', false);

                    }

        

                    //Grafico para Tickets por tipo de problema

        

                    const problema = [];

                    var cantidadSAP = 0;

                    var cantidadSoftware = 0;

                    var cantidadHardware = 0;

                    var cantidadRedes = 0;

                    var cantidadOtros = 0;

                    var cantidadEntregaInsumos = 0;

                    var cantidadReparaciones = 0;

        

                    respuesta.forEach(row => {

                        const tipoProblema = row.tipo_problema;

        

                        if (!problema.includes(tipoProblema)) {

                            problema.push(tipoProblema);

                            

                        }

        

                        if (tipoProblema == 'SAP') {

                            cantidadSAP++;

                        } else if (tipoProblema == 'Software') {

                            cantidadSoftware++;

                        } else if (tipoProblema == 'Hardware') {

                            cantidadHardware++;

                        }else if (tipoProblema == 'Redes') {

                            cantidadRedes++;

                        }else if (tipoProblema == 'Otros') {

                            cantidadOtros++;

                        }else if (tipoProblema == 'Entrega de Insumos') {

                            cantidadEntregaInsumos++;

                        }else if (tipoProblema == 'Reparaciones') {

                            cantidadReparaciones++;

                        }

                        });

        

                    //data

                    const data2 =   {labels: ['SAP','Software','Hardware','Redes','Otros','Entrega de Insumos', 'Reparaciones'],

                        datasets: [{

                            data: [cantidadSAP,cantidadSoftware,cantidadHardware,cantidadRedes,cantidadOtros,cantidadEntregaInsumos,cantidadReparaciones],

                            backgroundColor: [

                                'rgba(241, 196, 15,0.2)'

                            ],

                            borderColor: [

                                'rgba(241, 196, 15,1)'

                            ],

                            borderWidth: 1,

                        } 

                    ]};

                    //config

                    const configtp = {type: 'bar',

                                    data: data2,

                                    options: {

                                        plugins: {

                                            legend: false,

                                            datalabels: { //esta es la configuración de pluggin datalabels

                                                display: true,

                                                anchor: 'center',

                                                align: 'center',

                                            },

                                            scales: {

                                                y: {

                                                    beginAtZero: true

                                                }

                                            }

                                        },

                                        responsive: true,

                                        

                                    }

                                };



                    const configtp2 = {type: 'bar',

                        data: data2,

                        options: {

                            legend: false,

                            responsive: true,

                        }

                    };



                    if (grafico2){

                        grafico2.destroy();

                        Chart.register(ChartDataLabels);

                        grafico2 = new Chart(

                            document.getElementById("barTipoProblema").getContext('2d'),

                            configtp 

                        );

                        var imagen3 = JSON.stringify(configtp2);

                        $("#imagen3").val(imagen3);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        Chart.register(ChartDataLabels);

                        grafico2 = new Chart(

                            document.getElementById("barTipoProblema").getContext('2d'),

                            configtp

                        );

                        var imagen3 = JSON.stringify(configtp2);

                        $("#imagen3").val(imagen3);

                        $('.btnPDF').prop('disabled', false);

                    }

                }

            });

            $("#mensaje").html('');

            $("#contenidoReporte").removeClass('hidden');

        } else if (mes == '' && year != ''){

            var datos = new FormData();

            datos.append("year_old", year);

        

            $.ajax({

        

                url:"ajax/tickets.ajax.php",

                method: "POST",

                data: datos,

                cache: false,

                contentType: false,

                processData: false,

                dataType: "json",

                success: function(respuesta){

        

                    // Supongamos que el JSON devuelto por AJAX es así:

                    const dataFromAjax = respuesta;

                    

                    // Calcular la cantidad de registros en cada estado

                    let cantiAbiertos = 0;

                    let cantiEnProceso = 0;

                    let cantiResueltos = 0;

                    

                    dataFromAjax.forEach(row => {

                        if (row.estado == 3) {

                            cantiAbiertos++;

                        } else if (row.estado == 2) {

                            cantiEnProceso++;

                        } else if (row.estado == 1) {

                            cantiResueltos++;

                        }

                    });



                    console.log('abiertos',cantiAbiertos);

                    console.log('en proceso',cantiEnProceso);

                    console.log('resuelto',cantiResueltos);

        

                    var total = cantiAbiertos + cantiEnProceso + cantiResueltos;



                    console.log('total',total);

                    

                    var PorcentajeAbierto = ((cantiAbiertos / total) * 100).toFixed(0);

                    var PorcentajeEnProceso = ((cantiEnProceso / total) * 100).toFixed(0);

                    var PorcentajeResuelto = ((cantiResueltos / total) * 100).toFixed(0);

                    

                    datospie = {

                        labels: ["Abierto : "+ PorcentajeAbierto +' %', "En Proceso : "+ PorcentajeEnProceso +' %', "Resuelto : "+ PorcentajeResuelto +' %'],

                        datasets: [{

                            backgroundColor: ['rgba(239, 154, 154, 0.5)', 'rgba(241, 196, 15, 0.5)', 'rgba(0,166,149,0.5)'],

                            data: [PorcentajeAbierto,PorcentajeEnProceso,PorcentajeResuelto],

                        }]

                    }

        

                    opciones = {

                        legend: {

                            display: true,

                            position: 'bottom',

                            align: 'center',

                        },

                        plugins: {

                            datalabels: {

                                display: false,

                            },

                            aspectRatio: 12 / 6,

                            cutoutPercentage: 5,

                            layout: {

                                padding: 5

                            },

                            elements: {

                                line: {

                                    fill: false

                                },

                                point: {

                                    hoverRadius: 7,

                                    radius: 5

                                }

                            }

                        },

                        maintainAspectRatio: false,

                        responsive: true,

                    }

        

                    

        

                    if (grafico3){

                        const ctx = document.getElementById('pieEstadoTicket').getContext('2d');

                        ctx.height = 200;

                        grafico3.destroy();

                        Chart.register(ChartDataLabels);

                        grafico3 = new Chart(ctx, {

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        var imagen1 = JSON.stringify({

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        $("#total").val(total);

                        $("#imagen1").val(imagen1);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        const ctx = document.getElementById('pieEstadoTicket').getContext('2d');

                        ctx.height = 200;

                        Chart.register(ChartDataLabels);

                        grafico3 = new Chart(ctx, {

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        var imagen1 = JSON.stringify({

                            type: 'pie',

                            data: datospie,

                            options: opciones,

                        });

                        $("#total").val(total);

                        $("#imagen1").val(imagen1);

                        $('.btnPDF').prop('disabled', false);

                    }

        

                    //Grafico Bar para tickets asignado por persona

        

                    const persona = [];

                    const cantidadesAbiertos = [];

                    const cantidadesEnProceso = [];

                    const cantidadesResueltos = [];

        

                    respuesta.forEach(row => {

                        const nombre = row.asignado_a;

                        const estado = row.estado;

        

                        if (!persona.includes(nombre)) {

                            persona.push(nombre);

                            cantidadesAbiertos.push(0); // Inicializar con 0

                            cantidadesEnProceso.push(0); // Inicializar con 0

                            cantidadesResueltos.push(0); // Inicializar con 0

                        }

        

                        if (estado == 3) {

                            cantidadesAbiertos[persona.indexOf(nombre)]++;

                        } else if (estado == 2) {

                            cantidadesEnProceso[persona.indexOf(nombre)]++;

                        } else if (estado == 1) {

                            cantidadesResueltos[persona.indexOf(nombre)]++;

                        }

                    });

        

                    //Grafico para Tickets por persona asignada

                    //data

                    const data1 =   {labels: persona,

                                    datasets: [{

                                        label: 'Abiertos',

                                        data: cantidadesAbiertos,

                                        backgroundColor: [

                                        'rgba(239, 154, 154, 0.2)'

                                        ],

                                        borderColor: [

                                        'rgba(239, 154, 154, 1)'

                                        ],

                                        borderWidth: 1,

                                    },{

                                        label: 'En Proceso',

                                        data: cantidadesEnProceso,

                                        backgroundColor: [

                                            'rgba(241, 196, 15,0.2)'

                                        ],

                                        borderColor: [

                                            'rgba(241, 196, 15,1)'

                                        ],

                                        borderWidth: 1,

                                    },{

                                        label: 'Resuelto',

                                        data: cantidadesResueltos,

                                        backgroundColor: [

                                            'rgba(0,166,149,0.5)'

                                        ],

                                        borderColor: [

                                            'rgba(0,166,149,0.7)'

                                        ],

                                        borderWidth: 1,

                                    }]};

                    //config

                    const configpa = {type: 'bar',

                                    data: data1,

                                    options: {

                                        plugins: {

                                            legend: {

                                                position: 'bottom',

                                            },

                                            datalabels: { //esta es la configuración de pluggin datalabels

                                                display: true,

                                                anchor: 'center',

                                                align: 'center',

                                            },

                                            scales: {

                                                y: {

                                                    beginAtZero: true

                                                }

                                            }

                                        },

                                        responsive: true,

                                        

                                    }

                                };



                    const configpa2 = {type: 'bar',

                    data: data1,

                    options: {

                        legend: {

                            position: 'bottom',

                        },

                        datalabels: { //esta es la configuración de pluggin datalabels

                            

                        },

                        responsive: true,

                    }

                };

                    

                        

                    if (grafico1){

                        grafico1.destroy();

                        Chart.register(ChartDataLabels);

                        grafico1 = new Chart(

                            document.getElementById("barPersonaAsignada").getContext('2d'),

                            configpa

                        );

                        var imagen2 = JSON.stringify(configpa2);

                        $("#imagen2").val(imagen2);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        Chart.register(ChartDataLabels);

                        grafico1 = new Chart(

                            document.getElementById("barPersonaAsignada").getContext('2d'),

                            configpa

                        );

                        var imagen2 = JSON.stringify(configpa2);

                        $("#imagen2").val(imagen2);

                        $('.btnPDF').prop('disabled', false);

                    }

        

                    //Grafico para Tickets por tipo de problema

        

                    const problema = [];

                    var cantidadSAP = 0;

                    var cantidadSoftware = 0;

                    var cantidadHardware = 0;

                    var cantidadRedes = 0;

                    var cantidadOtros = 0;

                    var cantidadEntregaInsumos = 0;

                    var cantidadReparaciones = 0;

        

                    respuesta.forEach(row => {

                        const tipoProblema = row.tipo_problema;

        

                        if (!problema.includes(tipoProblema)) {

                            problema.push(tipoProblema);

                            

                        }

        

                        if (tipoProblema == 'SAP') {

                            cantidadSAP++;

                        } else if (tipoProblema == 'Software') {

                            cantidadSoftware++;

                        } else if (tipoProblema == 'Hardware') {

                            cantidadHardware++;

                        }else if (tipoProblema == 'Redes') {

                            cantidadRedes++;

                        }else if (tipoProblema == 'Otros') {

                            cantidadOtros++;

                        }else if (tipoProblema == 'Entrega de Insumos') {

                            cantidadEntregaInsumos++;

                        }else if (tipoProblema == 'Reparaciones') {

                            cantidadReparaciones++;

                        }

                        });

        

                    //data

                    const data2 =   {labels: ['SAP','Software','Hardware','Redes','Otros','Entrega de Insumos', 'Reparaciones'],

                        datasets: [{

                            data: [cantidadSAP,cantidadSoftware,cantidadHardware,cantidadRedes,cantidadOtros,cantidadEntregaInsumos,cantidadReparaciones],

                            backgroundColor: [

                                'rgba(241, 196, 15,0.2)'

                            ],

                            borderColor: [

                                'rgba(241, 196, 15,1)'

                            ],

                            borderWidth: 1,

                        } 

                    ]};

                    //config

                    const configtp = {type: 'bar',

                                    data: data2,

                                    options: {

                                        plugins: {

                                            legend: false,

                                            datalabels: { //esta es la configuración de pluggin datalabels

                                                display: true,

                                                anchor: 'center',

                                                align: 'center',

                                            },

                                            scales: {

                                                y: {

                                                    beginAtZero: true

                                                }

                                            }

                                        },

                                        responsive: true,

                                        

                                    }

                                };



                    const configtp2 = {type: 'bar',

                        data: data2,

                        options: {

                            legend: false,

                            datalabels: { //esta es la configuración de pluggin datalabels

                                display: true,

                                anchor: 'center',

                                align: 'center',

                            },

                            responsive: true,

                        }

                    };



                    if (grafico2){

                        grafico2.destroy();

                        Chart.register(ChartDataLabels);

                        grafico2 = new Chart(

                            document.getElementById("barTipoProblema").getContext('2d'),

                            configtp 

                        );

                        var imagen3 = JSON.stringify(configtp2);

                        $("#imagen3").val(imagen3);

                        $('.btnPDF').prop('disabled', false);

                    } else {

                        Chart.register(ChartDataLabels);

                        grafico2 = new Chart(

                            document.getElementById("barTipoProblema").getContext('2d'),

                            configtp

                        );

                        var imagen3 = JSON.stringify(configtp2);

                        $("#imagen3").val(imagen3);

                        $('.btnPDF').prop('disabled', false);

                    }

                }

            });

            $("#mensaje").html('');

            $("#contenidoReporte").removeClass('hidden');

        }

        

    });



    $(".btnCerrarModal").on('click', function(){

        $("#mensaje").html('');

        $("#contenidoReporte").addClass('hidden');

        $("#mes").val('');

        $("#year").val('');

        $("#imagen1").val('');

        $("#imagen2").val('');

        $("#imagen3").val('');

        $("#imagen3").val('');

        $('.btnPDF').prop('disabled', true);

        $('#mes').prop('disabled', true);

        $("#total").val('');

        

    });



});