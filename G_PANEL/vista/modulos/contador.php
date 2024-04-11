<?php
// Nombre del archivo JSON
$archivoJSON = "G_PANEL/vista/modulos/contador_visitas.json";

date_default_timezone_set('America/Asuncion');
// Obtener la fecha actual
$fecha_actual = date("Y-m-d");



// Leer el archivo JSON
if (file_exists($archivoJSON)) {
    $contador_data = json_decode(file_get_contents($archivoJSON), true);
} else {
    $contador_data = array();
}

// Verificar si ya existe una entrada para la fecha actual
if (!isset($contador_data[$fecha_actual])) {
    // Si no existe una entrada para la fecha actual, crear una nueva
    $contador_data[$fecha_actual] = 1;
} else {
    // Si ya existe una entrada para la fecha actual, incrementar el contador
    $contador_data[$fecha_actual]++;
}

// Escribir los datos actualizados en el archivo JSON
file_put_contents($archivoJSON, json_encode($contador_data));

// Obtener el contador para la fecha actual
$contador_fecha_actual = $contador_data[$fecha_actual];

// Obtener el total general de visitas sumando todos los contadores
$total_general = array_sum($contador_data);
?>
