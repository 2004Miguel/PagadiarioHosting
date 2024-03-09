<?php
    ini_set( 'display_errors', 1 );//La línea 1 y 2 permiten informar si el script no se ejecuta
    error_reporting( E_ALL );
    $from = "miguel@gestordeudas.online";//Correo desde el cual se va a enviar el mensaje
    $to = "vivianamarcela23@hotmail.com";//Destinatario del correo
    $subject = "Probando el envío de correos desde PHP";//Asunto del correo
    $message = "Parece que el envío desde PHP funciona";//Se redacta el mensaje
    $headers = "From:" . $from;//Detalla la información vital, como la dirección del remitente, la ubicación de respuesta, etc.
    mail($to,$subject,$message, $headers);//Esta línea ejecuta la función 
    echo "El correo fue enviado con exito";
?>