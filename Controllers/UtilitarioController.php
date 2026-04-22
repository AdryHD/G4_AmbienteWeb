<?php

function GenerarContrasena()
{
    // Más seguro: usa caracteres variados y es más fuerte
    $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $minusculas = 'abcdefghijklmnopqrstuvwxyz';
    $numeros    = '0123456789';
    $especiales = '!@#$%^&*';
    
    $todosLos = $mayusculas . $minusculas . $numeros . $especiales;
    $longitud = 12; // Contraseña más larga = más segura
    
    $contrasena = '';
    
    // Garantizar que tenga al menos un carácter de cada tipo
    $contrasena .= $mayusculas[rand(0, strlen($mayusculas) - 1)];
    $contrasena .= $minusculas[rand(0, strlen($minusculas) - 1)];
    $contrasena .= $numeros[rand(0, strlen($numeros) - 1)];
    $contrasena .= $especiales[rand(0, strlen($especiales) - 1)];
    
    // Llenar el resto aleatoriamente
    for ($i = 4; $i < $longitud; $i++) {
        $contrasena .= $todosLos[rand(0, strlen($todosLos) - 1)];
    }
    
    // Mezclar para que no siempre empiece con mayúscula
    $contrasena = str_shuffle($contrasena);
    
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

