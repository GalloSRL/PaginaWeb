<?php

	//Se importa los datos necesarios para el envio de Correo por Creacion de Tickets
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require_once "../controladores/ticket.controladorcord.php";
	require_once "../modelos/ticketcord.modelo.php";
	require_once "../controladores/usuario.controlador.php";
	require_once "../modelos/usuario.modelo.php";
class AjaxTickets{
	/*=============================================
	CREAR Ticket
	=============================================*/	
	public $data;
	public function ajaxCrearTicket(){
		$datos = $this->data;
		$tabla = "tickets";
		$respuesta = ModeloTicketsCord::mdlIngresarTicketCord($tabla, $datos);
		echo json_encode($respuesta);
	}

	/*=============================================
	EDITAR Ticket
	=============================================*/	
	public $idTicket;
	public function ajaxEditarTicket(){
		$item = "id";
		$valor = $this->idTicket;
		$respuesta = ControladorTicketsCord::ctrMostrarTicketsCord($item, $valor);
		echo json_encode($respuesta);
	}

	/*=============================================
	Estado Ticket
	=============================================*/	
	public $estadoTicket;
	public $estadoId;
	public function ajaxEstadoTicket(){
		$tabla = "tickets";
		$item1 = "estado";
		$valor1 = $this->estadoUsuario;
		$item2 = "id";
		$valor2 = $this->estadoId;
		$respuesta = ModeloTicketsCord::mdlActualizarTicketCord($tabla, $item1, $valor1, $item2, $valor2);
		echo json_encode($respuesta);
	}

	/*=============================================
	Borrado Ticket
	=============================================*/	
	public $BorradoTicket;
	public $BorradoId;
	public function ajaxBorradoTicket(){
		$tabla = "tickets";
		$item1 = "borrado";
		$valor1 = $this->BorradoTicket;
		$item2 = "id";
		$valor2 = $this->BorradoId;
		$respuesta = ModeloTicketsCord::mdlActualizarTicketCord($tabla, $item1, $valor1, $item2, $valor2);
		echo json_encode($respuesta);
	}

	/*=============================================
	Obtener Registros por Año y Mes
	=============================================*/	
	public $year;
	public $mes;
	public function ajaxAñoMesTicket(){
		$tabla = "tickets";
		$valor1 = $this->year;
		$valor2 = $this->mes;
		$respuesta = ModeloTicketsCord::MdlMostrarAñoMesTickets($tabla, $valor1, $valor2);
		echo json_encode($respuesta);
	}

	public $añosTickets;
	public function ajaxAñoTicket(){
		$tabla = "tickets";
		$valor1 = $this->añosTickets;
		$respuesta = ModeloTicketsCord::MdlMostrarAñoTickets($tabla, $valor1);
		echo json_encode($respuesta);
	}
}

/*=============================================
Crear ticket
=============================================*/
if(isset($_POST['nuevoProblema'])){
	$item = null;
	$valor = null;
	$tabla = "tickets";
	$respuesta = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
	$nro_ticket = ($respuesta[0][0]) + 1;
	$tabla = "tickets";
	$datos = array(	"nro_ticket" => $nro_ticket,
					"problema" => $_POST["nuevoProblema"],
					"tipo_problema" => $_POST['nuevoTipoProblema'],
					"prioridad" => $_POST['nuevoPrioridad'],
					"solicitado_por" => $_POST['nuevoSolicitadoPor'],
					"asignado_a" => $_POST['nuevoasignado'],
					"id_sucursal" => $_POST['nuevoIdSucursal'],
					"tiempo" => $_POST['nuevoTiempoEstimado']);
	$respuesta = ModeloTicketsCord::mdlIngresarTicketCord($tabla, $datos);
	if($respuesta == "ok"){
		//Se consulta para obtener el id del registro realizado
		$item = 'nro_ticket';
		$valor = $nro_ticket;
		$tabla = "tickets";
		$response = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
		$id = $response[0];// se Obtiene el id del ticket.
		require '../../PHPMailer/src/Exception.php';
		require '../../PHPMailer/src/PHPMailer.php';
		require '../../PHPMailer/src/SMTP.php';
		$problema = $_POST["nuevoProblema"];
		$email = $_POST["emailSolicitadoPor"];
		$tiempo = $_POST['nuevoTiempoEstimado'];
		$prioridad = $_POST['nuevoPrioridad'];
		$email_to = $email; //Destino 
		$contenido = '<p>
						<h3>Has generado un tickets de trabajo con los siguientes Detalles.</h3>
						<h4>Datos del Ticket.</h4>
						<strong>N° Ticket: </strong>'.$id.'<br>
						<strong>Descripción:</strong> '.$problema.'<br>
						<strong>Prioridad:</strong> '.$prioridad.'<br><br>
						<strong>Este correo se ha generado de forma automática, favor no responder.</strong><br><br>
					</p>
					<img src="cid:logoimg" style="width: 250px;">';
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 0;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
			$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
			$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
			$mail->Port       = 465;

			//Recipients
			$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
			$mail->addAddress($email_to);
			$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
			//Content
			$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
			$mail->Subject = 'Ticket Creado - '.$nro_ticket;
			$mail->Body    = $contenido;
			$mail->CharSet = 'UTF-8';
			if ($mail->send()){
				//Se consulta para obtener el id del registro realizado
				$item = 'nro_ticket';
				$valor = $nro_ticket;
				$tabla = "tickets";
				$response = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
				$id = $response[0];// se Obtiene el id del ticket.
				// obtner el nombre del usuario quien solicita
				$item2 = 'id';
				$valor2 = $_POST['nuevoSolicitadoPor'];
				$tabla = 'usuarios';
				$usuario = ModeloUsuarios::mdlMostrarUsuariosTop($tabla,$item2,$valor2);
				$solicitadopor = $usuario['nombre_user'];
				$problema = $_POST["nuevoProblema"];
				$email = 'informatica@gallosrl.com.py';
				$prioridad = $_POST['nuevoPrioridad'];
				$email_to = $email; //Destino 
				$contenido = '<p>
								<h3>Se ha generado un tickets de trabajo con los siguientes Detalles.</h3>
								<h4>Datos del Ticket.</h4>
								<strong>N° Ticket: </strong>'.$id.'<br>
								<strong>Solicitado por: </strong>'.$solicitadopor.'<br>
								<strong>Descripción:</strong> '.$problema.'<br>
								<strong>Prioridad:</strong> '.$prioridad.'<br><br>
								<strong>Este correo se ha generado de forma automática, favor no responder.</strong><br><br>
							</p>
							<img src="cid:logoimg" style="width: 250px;">';
				//Create an instance; passing `true` enables exceptions
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->SMTPDebug = 0;                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
					$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
					$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
					$mail->Port       = 465;

					//Recipients
					$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
					$mail->addAddress($email_to);
					$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
					//Content
					$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
					$mail->Subject = 'Ticket Creado - '.$nro_ticket;
					$mail->Body    = $contenido;
					$mail->CharSet = 'UTF-8';
					if ($mail->send()){
						if ($_POST['emailAsignadoA'] !== null){
							//Se consulta para obtener el id del registro realizado
							$item = 'nro_ticket';
							$valor = $nro_ticket;
							$tabla = "tickets";
							$response = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
							$id = $response[0];// se Obtiene el id del ticket.
							$problema = $_POST["nuevoProblema"];
							$email = $_POST["emailAsignadoA"];
							$tiempo = date("d-m-Y H:i:s", strtotime($_POST['nuevoTiempoEstimado']));
							$email_to = $email; //Destino 
							$contenido = '<p>
											<h3>Se ha generado un tickets de trabajo, la cual se te ha asignado.</h3>
											<h4>Datos del Ticket.</h4>
											<strong>N° Ticket: </strong>'.$id.'<br>
											<strong>Descripción:</strong> '.$problema.'<br>
											<strong>Plazo de Entrega:</strong> '.$tiempo.'<br>
											<strong>Favor de realizar la verificación en el tiempo establecido.</strong> <br><br>
											<strong>Atte.</strong><br>
											<strong> Dpto. de Informática</strong><br>
										</p>
										<img src="cid:logoimg" style="width: 250px;">';
							//Create an instance; passing `true` enables exceptions
							$mail = new PHPMailer(true);
							try {
								//Server settings
								$mail->SMTPDebug = 0;                      //Enable verbose debug output
								$mail->isSMTP();                                            //Send using SMTP
								$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
								$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
								$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
								$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
								$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
								$mail->Port       = 465;
				
								//Recipients
								$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
								$mail->addAddress($email_to);
								$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
								//Content
								$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
								$mail->Subject = 'Ticket Creado - '.$nro_ticket;
								$mail->Body    = $contenido;
								$mail->CharSet = 'UTF-8';
								if ($mail->send()){
									$res = 1;		
								}
							} catch (Exception $e) {
								$res = 2;
							}
						} else {
							$res = 1;
						}	
					}
				} catch (Exception $e) {
					$res = 2;
				}
			}
		} catch (Exception $e) {
			$res = 2;
		}
		
	} else {
		$res = 3;
	}
	echo json_encode($res);
}



/*============================================
EDITAR ticket
=============================================*/
if(isset($_POST['idTickets'])){
	if(	$_POST['editarProblema'] === $_POST['problema'] &&
		$_POST['editarTipoProblema'] === $_POST['tipoproblema'] &&
		$_POST['editarPrioridad'] === $_POST['prioridad'] &&
		$_POST['editarSolicitadoPor'] === $_POST['solicitado'] &&
		$_POST['editarasignado'] === $_POST['asignado'] &&
		$_POST['editarIdSucursal'] === $_POST['sucursal'] &&
		$_POST['editarTiempoEstimado'] === $_POST['tiempo']){
		$res = 1;
	}else {
		$nro_ticket = $_POST['idTickets'];
		$tabla = "tickets";
		$datos = array( "problema" => $_POST["editarProblema"],
						"tipo_problema" => $_POST['editarTipoProblema'],
						"prioridad" => $_POST['editarPrioridad'],
						"solicitado_por" => $_POST['editarSolicitadoPor'],
						"asignado_a" => $_POST['editarasignado'],
						"id_sucursal" => $_POST['editarIdSucursal'],
						"tiempo" => $_POST['editarTiempoEstimado'],
						"id" => $_POST['idTickets']);
		$respuesta = ModeloTicketsCord::mdlEditarTicketCord($tabla, $datos);
		if($respuesta == "ok"){
			//Se consulta para obtener el id del registro realizado
			$item = 'nro_ticket';
			$valor = $nro_ticket;
			$tabla = "tickets";
			$asignado = '';
			$response = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
			$id = $response[0];// se Obtiene el id del ticket.
			require '../../PHPMailer/src/Exception.php';
			require '../../PHPMailer/src/PHPMailer.php';
			require '../../PHPMailer/src/SMTP.php';
			$problema = $_POST["editarProblema"];
			$email = $_POST["emailSolicitadoPorEditar"];
			if($_POST['editarasignado'] !== ''){
				$asignado = '<br><strong>Asignado A: </strong>'.$_POST['editarasignado'];
			}
			$tiempo = $_POST['editarTiempoEstimado'];
			$prioridad = $_POST['editarPrioridad'];
			$email_to = $email; //Destino 
			$contenido = '<p>
							<h3>Has modificado un tickets de trabajo con los siguientes Detalles.</h3>
							<h4>Datos del Ticket.</h4>
							<strong>N° Ticket: </strong>'.$id.'<br>
							<strong>Descripción:</strong> '.$problema.'<br>
							<strong>Prioridad:</strong> '.$prioridad.$asignado.'
							<br><br>
							<strong>Este correo se ha generado de forma automática, favor no responder.</strong><br><br>
						</p>
						<img src="cid:logoimg" style="width: 250px;">';
			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->SMTPDebug = 0;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
				$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
				$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
				$mail->Port       = 465;
	
				//Recipients
				$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
				$mail->addAddress($email_to);
				$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
				//Content
				$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
				$mail->Subject = 'Ticket Modificado - '.$nro_ticket;
				$mail->Body    = $contenido;
				$mail->CharSet = 'UTF-8';
	
				if ($mail->send()){
					//Se consulta para obtener el id del registro realizado
					$item = 'nro_ticket';
					$valor = $nro_ticket;
					$tabla = "tickets";
					$asignado = '';
					$response = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
					$id = $response[0];// se Obtiene el id del ticket.
					// obtner el nombre del usuario quien solicita
					$item2 = 'id';
					$valor2 = $_POST['editarSolicitadoPor'];
					$tabla = 'usuarios';
					$usuario = ModeloUsuarios::mdlMostrarUsuariosTop($tabla,$item2,$valor2);
					$solicitadopor = $usuario['nombre_user'];
					$problema = $_POST["editarProblema"];
					if($_POST['editarasignado'] !== ''){
						$asignado = '<br><strong>Asignado A: </strong>'.$_POST['editarasignado'];
					}
					$email = 'informatica@gallosrl.com.py';
					$prioridad = $_POST['editarPrioridad'];
					$email_to = $email; //Destino 
					$contenido = '<p>
									<h3>Se ha modificado un tickets de trabajo con los siguientes Detalles.</h3>
									<h4>Datos del Ticket.</h4>
									<strong>N° Ticket: </strong>'.$id.'<br>
									<strong>Solicitado por: </strong>'.$solicitadopor.'<br>
									<strong>Descripción:</strong> '.$problema.'<br>
									<strong>Prioridad:</strong> '.$prioridad.$asignado.'<br><br>
									<strong>Este correo se ha generado de forma automática, favor no responder.</strong><br><br>
								</p>
								<img src="cid:logoimg" style="width: 250px;">';
					//Create an instance; passing `true` enables exceptions
					$mail = new PHPMailer(true);
					try {
						//Server settings
						$mail->SMTPDebug = 0;                      //Enable verbose debug output
						$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
						$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
						$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
						$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
						$mail->Port       = 465;
	
						//Recipients
						$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
						$mail->addAddress($email_to);
						$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
						//Content
						$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
						$mail->Subject = 'Ticket Modificado - '.$nro_ticket;
						$mail->Body    = $contenido;
						$mail->CharSet = 'UTF-8';
						if ($mail->send()){
							if ($_POST['emailAsignadoAEditar'] !== ''){
								$email = $_POST["emailAsignadoAEditar"];
								$tiempo = date("d-m-Y", strtotime($_POST['editarTiempoEstimado']));
								$email_to = $email; //Destino 
								$contenido = '<p>
												<h3>Se ha modificado un tickets de trabajo, la cual se te ha asignado.</h3>
												<h4>Datos del Ticket.</h4>
												<strong>N° Ticket: </strong>'.$id.'<br>
												<strong>Descripción:</strong> '.$problema.'<br>
												<strong>Plazo de Entrega:</strong> '.$tiempo.'<br>
												<strong>Favor de realizar la verificación en el tiempo establecido.</strong> <br><br>
												<strong>Atte.</strong><br>
												<strong> Dpto. de Informática</strong><br>
											</p>
											<img src="cid:logoimg" style="width: 250px;">';
								//Create an instance; passing `true` enables exceptions
								$mail = new PHPMailer(true);
								try {
									//Server settings
									$mail->SMTPDebug = 0;                      //Enable verbose debug output
									$mail->isSMTP();                                            //Send using SMTP
									$mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
									$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
									$mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
									$mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
									$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
									$mail->Port       = 465;
					
									//Recipients
									$mail->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
									$mail->addAddress($email_to);
									$mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
									//Content
									$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
									$mail->Subject = 'Ticket Modificado - '.$nro_ticket;
									$mail->Body    = $contenido;
									$mail->CharSet = 'UTF-8';
									if ($mail->send()){
										$res = 1;		
									}
								} catch (Exception $e) {
									$res = 2;
								}
							} else {
								
								$res = 1;
							}	
						}
					} catch (Exception $e) {
						$res = 2;
					}
				}
			} catch (Exception $e) {
				
				$res = 2;
			}
			
		} else {
			$res = 3;
		}
	}

	echo json_encode($res);
	die();
}


/*=============================================
Estado Ticket
=============================================*/	
if(isset($_POST["estadoTicket"])){
	$estadoTicket = new AjaxTickets();
	$estadoTicket -> estadoTicket = $_POST["estadoTicket"];
	$estadoTicket -> estadoId = $_POST["estadoId"];
	$activarTicket -> ajaxEstadoTicket();
}

/*=============================================
Obtener registro de Tickets para los graficos
=============================================*/	
if(isset($_POST["year_old"])){
	$añosTicket = new AjaxTickets();
	$añosTicket -> añosTickets = $_POST["year_old"];
	$añosTicket -> ajaxAñoTicket();
}

if(isset($_POST["year"]) && isset($_POST["mes"])){
	$añoMesTicket = new AjaxTickets();
	$añoMesTicket -> year = $_POST["year"];
	$añoMesTicket -> mes = $_POST["mes"];
	$añoMesTicket -> ajaxAñoMesTicket();
} 

/*=============================================
Borrar Ticket
=============================================*/	
if(isset($_POST["BorradoTicket"])){
	$BorradoTicket = new AjaxTickets();
	$BorradoTicket -> BorradoTicket = $_POST["BorradoTicket"];
	$BorradoTicket -> BorradoId = $_POST["BorradoId"];
	$BorradoTicket -> ajaxBorradoTicket();
}

/*=============================================
Estado Ticket
=============================================*/	
if(isset($_POST["id"])){
	$idTicket = new AjaxTickets();
	$idTicket -> idTicket = $_POST["id"];
	$idTicket -> ajaxEditarTicket();
}