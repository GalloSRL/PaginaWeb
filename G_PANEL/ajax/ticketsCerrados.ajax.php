<?php
	//Se importa los datos necesarios para el envio de Correo por Creacion de Tickets
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require_once "../controladores/ticket.controladorcord.php";
	require_once "../modelos/ticketcord.modelo.php";
    if($_POST["estado"] == 1){
        $fechaFinTrabajo = $_POST['fechacierre'];
        if($fechaFinTrabajo != ''){
            $fecha = date_create($_POST['fechacierre']);
            $fechaCierre = date_format($fecha, 'Y-m-d H:i:s');
        } else{
            $fechaCierre = '0000-00-00 00:00:00';
        }
        $item = 'id';
        $valor = $_POST['id_Tickets'];
        $tabla = "tickets";
        $datos = array("comentarios" => $_POST["comentarios"],
                        "estado" => $_POST['estado'],
                        "fecha_fin_trabajo" => $fechaCierre,
                        "id" => $_POST['id_Tickets']);

        $nro_ticket = $_POST['id_Tickets'];
        $respuesta = ModeloTicketsCord::mdlEditarTicketEstadoCord($tabla, $datos);
        if($respuesta == "ok"){
            require '../../PHPMailer/src/Exception.php';
            require '../../PHPMailer/src/PHPMailer.php';
            require '../../PHPMailer/src/SMTP.php';
            $problema = $_POST["problemaInput"];
            $asignado = $_POST['asiga'];
            $email = $_POST["correo"];
            $email_to = $email; //Destino 
            $comentarios = $_POST["comentarios"];
            $contenido = '<p>
                            <h3>Se ha cerrado un tickets de trabajo solicitado al Dpto de Informática.</h3>
                            <h4>Datos del Ticket.</h4>
                            <strong>N° Ticket:</strong> '.$nro_ticket.'<br>
                            <strong>Descripción:</strong> '.$problema.'<br>
                            <strong>Asignado a:</strong> '.$asignado.'.<br>
                            <strong>Comentario:</strong> '.$comentarios.'.<br>
                            <strong>Esta Solicitud queda cerrada.</strong><br><br>
                            <strong>Este correo se ha generado de forma automática, favor no responder.</strong><br>
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
                $mail->addCC('informatica@gallosrl.com.py');
                $mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Ticket Cerrado - Nro. '.$nro_ticket;
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
    } else if($_POST["estado"] !== 1){
            if($_POST["estado"] == 2){
                $estado = 'En Proceso';
            } else if ($_POST["estado"] == 3){
                $estado = 'Abierto';
            }
            $fechaFinTrabajo = $_POST['fechacierre'];
            if($fechaFinTrabajo != ''){
                $fecha = date_create($_POST['fechacierre']);
                $fechaCierre = date_format($fecha, 'Y-m-d H:i:s');
            } else{
                $fechaCierre = '0000-00-00 00:00:00';
            }
            $item = 'id';
            $valor = $_POST['id_Tickets'];
            $tabla = "tickets";
            $datos = array("comentarios" => $_POST["comentarios"],
                            "estado" => $_POST['estado'],
                            "fecha_fin_trabajo" => $fechaCierre,
                            "id" => $_POST['id_Tickets']);
            $respuestaQuery = ModeloTicketsCord::MdlMostrarTicketsCord($tabla, $item, $valor);
            $nro_ticket = $respuestaQuery['id'];
            $respuesta = ModeloTicketsCord::mdlEditarTicketEstadoCord($tabla, $datos);
            if($respuesta == "ok"){
                require '../../PHPMailer/src/Exception.php';
                require '../../PHPMailer/src/PHPMailer.php';
                require '../../PHPMailer/src/SMTP.php';
                $problema = $_POST["problemaInput"];
                $asignado = $_POST['asiga'];
                $email = $_POST["correo"];
                $email_to = $email; //Destino 
                $contenido = '<p>
                                <h3>Se ha cambiado el estado de un ticket de trabajo solicitado al Dpto de Informática.</h3>
                                <h4>Datos del Ticket.</h4>
                                <strong>N° Ticket:</strong> '.$nro_ticket.'<br>
                                <strong>Descripción:</strong> '.$problema.'<br>
                                <strong>Asignado a:</strong> '.$asignado.'<br>
                                <strong>Estado:</strong> '.$estado.'<br><br>
                                <strong>Este correo se ha generado de forma automática, favor no responder.</strong><br>
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
                    $mail->addCC('informatica@gallosrl.com.py');
                    $mail->AddEmbeddedImage('../vista/modulos/logo-gallosrl.png', 'logoimg', 'xx.png', 'base64', 'image/png');
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Ticket Nro. '.$nro_ticket;
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
    // } else {
    //     $fechaFinTrabajo = $_POST['fechacierre'];
    //     if($fechaFinTrabajo != ''){
    //         $fecha = date_create($_POST['fechacierre']);
    //         $fechaCierre = date_format($fecha, 'Y-m-d H:i:s');
    //     } else{
    //         $fechaCierre = '0000-00-00 00:00:00';
    //     }
    //     $tabla = "tickets";
    //     $datos = array("comentarios" => $_POST["comentarios"],
    //                     "estado" => $_POST['estado'],
    //                     "fecha_fin_trabajo" => $fechaCierre,
    //                     "id" => $_POST['id_Tickets']);
    //     $respuesta = ModeloTicketsCord::mdlEditarTicketEstadoCord($tabla, $datos);
    //     if($respuesta == "ok"){
    //         $res = 1;
    //     } else{
    //         $res = 3;
    //     }
    //     echo json_encode($res);
    // }