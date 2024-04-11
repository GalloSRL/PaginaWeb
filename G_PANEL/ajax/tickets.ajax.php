<?php

	//Se importa los datos necesarios para el envio de Correo por Creacion de Tickets
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once "../controladores/ticket.controlador.php";
	require_once "../modelos/ticket.modelo.php";

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

		$respuesta = ControladorTickets::ctrMostrarTickets($item, $valor);

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
if(isset($_POST['email'])){

	$item = null;
	$valor = null;
	$tabla = "tickets";
	$respuesta = ModeloTickets::MdlMostrarTickets($tabla, $item, $valor);
	$nro_ticket = count($respuesta)+1;

	$tabla = "tickets";
	$datos = array(	"nro_ticket" => $nro_ticket,
					"problema" => $_POST["nuevoProblema"],
					"tipo_problema" => $_POST['nuevoTipoProblema'],
					"prioridad" => $_POST['nuevoPrioridad'],
					"solicitado_por" => $_POST['nuevoSolicitadoPor'],
					"asignado_a" => $_POST['nuevoasignado'],
					"id_sucursal" => $_POST['nuevoIdSucursal']);
	$respuesta = ModeloTickets::mdlIngresarTicket($tabla, $datos);
	if($respuesta == "ok"){
		//Se consulta para obtener el id del registro realizado
		$item = 'nro_ticket';
		$valor = $nro_ticket;
		$tabla = "tickets";
		$response = ModeloTickets::MdlMostrarTickets($tabla, $item, $valor);
		$id = $response[0];// se Obtiene el id del ticket.

		require '../../PHPMailer/src/Exception.php';
		require '../../PHPMailer/src/PHPMailer.php';
		require '../../PHPMailer/src/SMTP.php';
		$problema = $_POST["nuevoProblema"];
		$email = $_POST["email"];

		$email_to = $email; //Destino 
		$contenido = '<p>
						<h3>Se ha Generado un Tickets de Trabajo, la cual se te ha asignado.</h3>
						<h4>Datos del Ticket.</h4>
						<strong>Nro de Ticket: </strong>'.$id.'<br>
						<strong>Problema:</strong> '.$problema.'<br>
						<strong>Favor de realizar la verificación del mismo en la brevedad posible.</strong> <br><br>
						<strong>   Atte</strong><br>
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
			$mail->setFrom("informatica1@gallosrl.com.py","Dpto. de Informática");
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
		$res = 3;
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



