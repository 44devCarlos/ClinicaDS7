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
            <div style='
                height: auto; 
                display: flex; 
                justify-content: center; 
                align-items: center; 
                background-color: rgba(255, 255, 255, 0.9); 
                border-radius: 15px; 
                padding: 50px; 
                text-align: center;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);'>
                <div>
                    <img src='https://i.ibb.co/9GWF8dh/Clinica-Vitalis-login.png' style='margin-bottom: 20px;'>
                    <h1 style='color: #0B3E57; margin-bottom: 20px;'>Recuperación de Contraseña</h1>
                    <p>Email: <b>$usuario->email</b></p>
                    <p>Contraseña temporal: <b>$contrasena</b></p>
                    <p style='margin-top: 20px;'> 
                        <b>Le recomendamos que cambie de contraseña en el siguiente enlace:</b>
                    </p>
                    <a href='http://localhost:3000/views/actualizar/cambiar_contrasena.php?e=$usuario->email&h=$usuario->restablecer'
                    style='display: inline-block; padding: 10px 20px; margin-top: 20px; color: #fff; text-decoration: none; background-color: #0B3E57; border-radius: 5px;'>
                        CAMBIAR CONTRASEÑA
                    </a>
                </div>
            </div>";



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

    public function enviar_factura($email, $servicio, $cantidad, $nombre)
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
        <div style='
            font-family: Arial, sans-serif;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;'>
            <div style='margin-bottom: 20px;'>
                <img src='https://i.ibb.co/9GWF8dh/Clinica-Vitalis-login.png' style='width: 300px; height: auto;'>
            </div>
            <h2 style='margin: 10px 0; color: #333;'>Factura</h2>
            <p style='margin: 5px 0; font-size: 14px; color: #555;'>
                Número de Factura: <b>149630</b>
            </p>
            <p style='margin: 5px 0; font-size: 14px; color: #555;'>
                Usuario: <b>$nombre</b>
            </p>
            <p style='margin: 10px 0; font-size: 16px; font-weight: bold; color: #007BFF;'>
                Servicio Ofrecido: <b>$servicio</b>
            </p>
            <p style='margin: 10px 0; font-size: 16px; font-weight: bold; color: #28A745;'>
                Monto: <b>$$cantidad</b>
            </p>
        </div>";



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'ClinicaDS7-Recibo Eléctronico';
        $mail->CharSet = 'UTF-8';
        $mail->Body    = $mensajeHTML;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }
}
