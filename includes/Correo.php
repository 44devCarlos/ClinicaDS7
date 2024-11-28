<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/Exception.php";
require "../PHPMailer/PHPMailer.php";
require "../PHPMailer/SMTP.php";

class Correo
{
    private $conn;
    public $resp;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function cambiar_pass($email, Usuarios $usuario, $contrasena)
    {
        if ($usuario->consultar_usuario_por_email($email)) {
            $usuario->restablecer = md5(rand(1, 1000));
            $usuario->email = $email;
            $this->resp = $usuario->IncluirHash($usuario);
            //Enviar email
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'clinicads7@gmail.com';        //SMTP username
            $mail->Password   = 'jgxctriastapfzew';            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('clinicads7@gmail.com', 'Clinica DS 7');
            $mail->addAddress($usuario->email);
            //plantilla HTML

            $mensajeHTML = "
                <p align='center'> 
                <img src='https://utp.ac.pa/documentos/2015/imagen/logo_utp_1_72.png' width='100px' height='100px' >
                </p>
                <p align='center'>Email: $usuario->email</p>
                <p align='center'>Contrase&ntilde;a: $contrasena</p>
                <p align='center'><b>Le recomendamos que cambie de contraseña en el siguiente enlace: </b></p>
                <p align='center'>
                <a href='http://localhost:3000/views/actualizar/cambiar_contrasena.php?e=$usuario->email&h=$usuario->restablecer'>CAMBIAR</a><br />
                </p>";


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'ClinicaDS7-Restablecer contraseña';
            $mail->CharSet = 'UTF-8';
            $mail->Body    = $mensajeHTML;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } else {
        }
    }

    public function enviar_factura($email, $servicio, $cantidad)
    {
        //Enviar email
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'clinicads7@gmail.com';        //SMTP username
        $mail->Password   = 'jgxctriastapfzew';            //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('clinicads7@gmail.com', 'Clinica DS 7');
        $mail->addAddress($email);
        //plantilla HTML

        $mensajeHTML = "
                <p align='center'> 
                <img src='https://utp.ac.pa/documentos/2015/imagen/logo_utp_1_72.png' width='100px' height='100px' >
                </p>
                <p align='center'>Servicio Ofrecido <b>$servicio</b></p>
                <p align='center'>Monto de <b>$$cantidad</b></p>";


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'ClinicaDS7-Recibo Eléctronico';
        $mail->CharSet = 'UTF-8';
        $mail->Body    = $mensajeHTML;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }
}
