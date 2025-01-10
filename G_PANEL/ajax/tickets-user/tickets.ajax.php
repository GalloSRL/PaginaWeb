<?php



	//Se importa los datos necesarios para el envio de Correo por Creacion de Tickets
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require_once "../../controladores/ticket.controlador.php";
	require_once "../../modelos/ticket.modelo.php";
	require_once "../../controladores/usuario.controlador.php";
	require_once "../../modelos/usuario.modelo.php";

class AjaxTickets{

	/*=============================================
	CREAR Ticket
	=============================================*/	
	public $data;
	public function ajaxCrearTicket(){
		$datos = $this->data;
		$tabla = "tickets";
		$respuesta = ModeloTickets::mdlIngresarTicket($tabla, $datos);
		echo json_encode($respuesta);
	}



	/*=============================================
	EDITAR Ticket
	=============================================*/	
	public $idTicket;
	public function ajaxEditarTicket(){
		$item = "id";
		$valor = $this->idTicket;
		$respuesta = ControladorTickets::ctrMostrarTicketsEditar($item, $valor);
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
		$respuesta = ModeloTickets::mdlActualizarTicket($tabla, $item1, $valor1, $item2, $valor2);
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
		$respuesta = ModeloTickets::mdlActualizarTicket($tabla, $item1, $valor1, $item2, $valor2);
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
		$respuesta = ModeloTickets::MdlMostrarAñoMesTickets($tabla, $valor1, $valor2);
		echo json_encode($respuesta);
	}

	public $añosTickets;
	public function ajaxAñoTicket(){
		$tabla = "tickets";
		$valor1 = $this->añosTickets;
		$respuesta = ModeloTickets::MdlMostrarAñoTickets($tabla, $valor1);
		echo json_encode($respuesta);
	}
}


/*=============================================
Crear ticket
=============================================*/
if(isset($_POST['emailSolicitadoPor'])){
	$item = null;
	$valor = null;
	$tabla = "tickets";
	$respuesta = ModeloTickets::MdlMostrarTickets($tabla, $item, $valor);
	$nro_ticket = ($respuesta[0][0]) + 1;
	$tabla = "tickets";
	$datos = array(	"nro_ticket" => $nro_ticket,
					"problema" => $_POST["nuevoProblema"],
					"prioridad" => $_POST['nuevoPrioridad'],
					"solicitado_por" => $_POST['nuevoSolicitadoPor']);
	$respuesta = ModeloTickets::mdlIngresarTicketUser($tabla, $datos);
	if($respuesta == "ok"){
		// Obtener el ultimo ID del Ticket Registrado
		$id = $nro_ticket;// se Obtiene el id del ticket.
		require '../../../PHPMailer/src/Exception.php';
		require '../../../PHPMailer/src/PHPMailer.php';
		require '../../../PHPMailer/src/SMTP.php';
		$problema = $_POST["nuevoProblema"];
		$email = $_POST["emailSolicitadoPor"];
		$prioridad = $_POST["nuevoPrioridad"];
		$email_to = $email; //Destino User
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
			$mail->AddEmbeddedImage('../../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
			//Content
			$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
			$mail->Subject = 'Ticket Creado - '.$id;
			$mail->Body    = $contenido;
			$mail->CharSet = 'UTF-8';
			if ($mail->send()){
				$id = $nro_ticket;// se Obtiene el id del ticket.
				// obtner el nombre del usuario quien solicita
				$item2 = 'id';
				$valor2 = $_POST['nuevoSolicitadoPor'];
				$tabla = 'usuarios';
				$usuario = ModeloUsuarios::mdlMostrarUsuariosTop($tabla,$item2,$valor2);
				$solicitadopor = $usuario['nombre_user'];
				$problema = $_POST["nuevoProblema"];
				$email = 'informatica@gallosrl.com.py';
				$prioridad = $_POST["nuevoPrioridad"];
				$email_to = $email; //Destino User
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
				$mail2 = new PHPMailer(true);
				try {
					//Server settings
					$mail2->SMTPDebug = 0;                      //Enable verbose debug output
					$mail2->isSMTP();                                            //Send using SMTP
					$mail2->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
					$mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail2->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
					$mail2->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
					$mail2->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
					$mail2->Port       = 465;
					//Recipients
					$mail2->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
					$mail2->addAddress($email_to);
					$mail2->AddEmbeddedImage('../../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
					//Content
					$mail2->isHTML(true);                                  //Bool True de que el contenido del email es html
					$mail2->Subject = 'Ticket Creado - '.$id;
					$mail2->Body    = $contenido;
					$mail2->CharSet = 'UTF-8';
					if ($mail2->send()){
						$res = 1;		
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


/*=============================================
Editar Tickets
=============================================*/
if(isset($_POST['idTickets'])){
	$tabla = "tickets";
	if ($_POST["editarProblema"] === $_POST["problemahidden"] && $_POST['editarPrioridad'] === $_POST['prioridadhidden']){
		$res = 1;
	} else {
		$datos = array(	"problema" => $_POST["editarProblema"],
					"prioridad" => $_POST['editarPrioridad'],
					"id" => $_POST["idTickets"]);
		$respuesta = ModeloTickets::mdlEditarTicketUser($tabla, $datos);
		if($respuesta == "ok"){
			$id = $_POST['idTickets'];// se Obtiene el id del ticket.
			require '../../../PHPMailer/src/Exception.php';
			require '../../../PHPMailer/src/PHPMailer.php';
			require '../../../PHPMailer/src/SMTP.php';
			$asignado = '';
			$problema = $_POST["editarProblema"];
			$email = $_POST["editaremailSolicitadoPor"];
			$prioridad = $_POST["editarPrioridad"];
			$email_to = $email; //Destino User
			$email_cc = $_POST["editaremailAsignadoA"];
			if($_POST['editaremailAsignadoA'] !== ''){
				$asignado = '<br><strong>Asignado A: </strong>'.$_POST['editarAsignadoA'];
			}
			$contenido = '<p>
							<h3>Has Modificado un ticket de trabajo creado anteriormente con los siguientes Detalles.</h3>
							<h4>Datos del Ticket.</h4>
							<strong>N° Ticket: </strong>'.$id.'<br>
							<strong>Descripción:</strong> '.$problema.'<br>
							<strong>Prioridad:</strong> '.$prioridad.$asignado.'<br><br>
							<strong>El cambio realizado fue comunicado al Dpto. de Informática.</strong>
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
				$mail->AddEmbeddedImage('../../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
				//Content
				$mail->isHTML(true);                                  //Bool True de que el contenido del email es html
				$mail->Subject = 'Ticket Modificado - '.$id;
				$mail->Body    = $contenido;
				$mail->CharSet = 'UTF-8';
				if ($mail->send()){
					// obtner el nombre del usuario quien solicita
					$email_copia = null;
					$item2 = 'id';
					$valor2 = $_POST['editarSolicitadoPor'];
					$tabla = 'usuarios';
					$usuario = ModeloUsuarios::mdlMostrarUsuariosTop($tabla,$item2,$valor2);
					$solicitadopor = $usuario['nombre_user'];
					$problema = $_POST["editarProblema"];
					$email = 'informatica@gallosrl.com.py';
					$email_copia = $_POST['editaremailAsignadoA'];
					$prioridad = $_POST["editarPrioridad"];
					$email_to = $email; //Destino User
					if($_POST['editaremailAsignadoA'] !== ''){
						$asignado = '<br><strong>Asignado A: </strong>'.$_POST['editarAsignadoA'];
					}
					$contenido2 = '<p>
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
					$mail2 = new PHPMailer(true);
					try {
						//Server settings
						$mail2->SMTPDebug = 0;                      //Enable verbose debug output
						$mail2->isSMTP();                                            //Send using SMTP
						$mail2->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
						$mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail2->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
						$mail2->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
						$mail2->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
						$mail2->Port       = 465;
						//Recipients
						$mail2->setFrom("soporte@gallosrl.com.py","Dpto. de Informática - SOPORTE");
						$mail2->addAddress($email_to);
						if($email_copia != null){
							$mail2->addCC($email_copia);
						}
						
						$mail2->AddEmbeddedImage('../../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
						//Content
						$mail2->isHTML(true);                                  //Bool True de que el contenido del email es html
						$mail2->Subject = 'Ticket Modificado - '.$id;
						$mail2->Body    = $contenido2;
						$mail2->CharSet = 'UTF-8';
						if ($mail2->send()){
							$res = 1;		
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
}


/*=============================================
EDITAR ticket
=============================================*/
if(isset($_POST["idTicket"])){
	$editar = new AjaxTickets();
	$editar -> idTicket = $_POST["idTicket"];
	$editar -> ajaxEditarTicket();
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
Borrar Ticket
=============================================*/	
if(isset($_POST["BorradoTicket"])){
	$BorradoTicket = new AjaxTickets();
	$BorradoTicket -> BorradoTicket = $_POST["BorradoTicket"];
	$BorradoTicket -> BorradoId = $_POST["BorradoId"];
	$BorradoTicket -> ajaxBorradoTicket();
}
