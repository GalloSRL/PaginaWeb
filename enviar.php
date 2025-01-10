<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    
    if (!empty($_POST)) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"]; 
        $captcha = $_POST["g-recaptcha-response"];

        $email_to = "gallosrl@gallosrl.com.py"; 
        $contenido = '<p>
                        <h3>'.$name.' ha contactado desde la web de GALLO SRL.</h3>
                        <h4>Datos de la Persona.</h4>
                        <strong>Nombre Completo:</strong> '.$name.'<br>
                        <strong>Mail:</strong> '.$email.'<br>
                        <strong>Nro de Contacto:</strong> '.$phone.'<br>
                        <strong>Mensaje:</strong> '.$message.'<br>
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
                        $mail->Password   = '~#MaSht?}Y7o';                               //Contaseña de la cuenta de correo anterior
                        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom($email, $name);
                        $mail->addAddress($email_to);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Contacto desde la Web Gallo SRL';
                        $mail->Body    = $contenido;
                        $mail->CharSet = 'UTF-8';
                        
                        $mail->send();
                        echo 2;
                    } catch (Exception $e) {
                        echo 3;
                    }
                } else {
                    echo 4;
                }
            }

    }

?>