<?php

	require_once "../modelos/conexion.php";
	require_once "../controladores/cliente.controlador.php";
	require_once "../modelos/cliente.modelo.php";

    // Verifica si se recibieron los datos mediante POST y si los datos son una cadena JSON
	if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["datos"]) && is_string($_POST["datos"])) {
		// Decodifica los datos JSON recibidos a un arreglo en PHP
		$datosExportados = json_decode($_POST["datos"], true);

		
	
		// Verifica si la decodificación fue exitosa
		if ($datosExportados == null) {
			echo "Error al decodificar los datos JSON.";
			exit;
		}
		
		$cont = 0;
		// Recorre cada fila y actualiza el estado de 1 a 2
		foreach ($datosExportados as $fila) {
			$id = $fila[1]; 

			
			
			// Realiza la consulta de actualización en la base de datos para cambiar el estado de 1 a 2
			// (Aquí debes implementar la lógica específica para actualizar el estado en tu base de datos)
			// Ejemplo: (la consulta puede variar dependiendo de tu base de datos y la estructura de la tabla)
			$stmt = Conexion::conectar()->prepare("UPDATE clientes SET status = 0 WHERE id = :id");
			$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
			if ($stmt->execute()){
				$cont++;
			};
		}
	
		// Envia una respuesta de éxito al cliente
		echo $cont;
	
	} else {
		// Envia un mensaje de error si los datos no fueron recibidos correctamente
		return 'Error';
	}
?>
