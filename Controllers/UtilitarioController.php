<?php

function GenerarContrasena()
{
    $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 8;
    $contrasena = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, strlen($letras) - 1);
        $contrasena .= $letras[$indice];
    }

    return $contrasena;
}

function EnviarCorreo($asunto, $contenido, $destinatario)
{
    require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require_once __DIR__ . '/PHPMailer/src/SMTP.php';

    $correoSalida     = "ahernandez10645@ufide.ac.cr";
    $contrasenaSalida = "";

    if ($contrasenaSalida == "") {
        return true; 
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPAuth   = true;
    $mail->Username   = $correoSalida;
    $mail->Password   = $contrasenaSalida;

    $mail->setFrom($correoSalida, 'PowerZone');
    $mail->Subject = $asunto;
    $mail->msgHTML($contenido);
    $mail->addAddress($destinatario);
    $mail->send();
}

