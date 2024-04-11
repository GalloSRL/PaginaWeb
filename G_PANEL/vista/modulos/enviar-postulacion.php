<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';
    require_once "../modelos/vacancia.modelo.php";

    
    if (!empty($_POST)) {

        $id = $_POST["id"];
        $vacancia = $_POST["vacancia"];
        $nombre = $_POST["post_nombre"];
        $ci = $_POST["post_ci"];
        $telefono = $_POST["post_telefono"];
        $email = $_POST["post_email"];
        $mensaje = $_POST["post_mensaje"];
        $archivo = $_FILES['post_archivo'];
        $nombre_archivos = $archivo['name'];
        $ruta_archivos =$archivo['tmp_name']; 
        $captcha = $_POST["g-recaptcha-response"];
        $conteo = intval($_POST['conteoPostulacion']);

        $email_to = "desarrollohumano1@gallosrl.com.py"; 
        $contenido = '<p>
                        <h3>'.$nombre.' ha contactado desde la web de GALLO SRL. por la postulación de '.$vacancia.'</h3>
                        <h4>Datos de la Persona.</h4>
                        <strong>Nombre Completo:</strong> '.$nombre.'<br>
                        <strong>Numero de Cédula:</strong> '.$ci.'<br>
                        <strong>Correo:</strong> '.$email.'<br>
                        <strong>Celular:</strong> '.$telefono.'<br>
                        <strong>Mensaje:</strong> '.$mensaje.'<br>
                    </p>'; 
        
        $secret = '6LcQilwmAAAAAO7ijaFZuTtUktTThshTMqz-XN5E';

        if (!$captcha) {
            echo 1;
        } else {
            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

                $arr = json_decode($response, true);
                if ($arr['success']) {

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'mail.gallosrl.com.py';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'gallosrl@gallosrl.com.py';                     //Quien envia el correo
                        $mail->Password   = 'Gallosrl2023*';                               //Contaseña de la cuenta de correo anterior
                        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom($email, $nombre);
                        $mail->addAddress($email_to);

                        //Archivos Adjuntos
                        $mail->AddAttachment($ruta_archivos, $nombre_archivos);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $vacancia;
                        $mail->Body    = $contenido;
                        $mail->CharSet = 'UTF-8';
                        
                        
                        if ($mail->send()){

                            $tabla = "vacancias";

                            $item1 = "conteo_postulaciones";
                            $valor1 = $conteo + 1;
                            $item2 = "id";
                            $valor2 = $id;

                            $respuesta = ModeloVacancias::mdlActualizarVacancia($tabla, $item1, $valor1, $item2, $valor2);
                            
                            if($respuesta == 'ok'){
                                echo 2;
                            }

                        }
                    } catch (Exception $e) {
                        echo 3;
                    }
                } else {
                    echo 4;
                }
            }

    } else {
        echo 5;
    }

?>