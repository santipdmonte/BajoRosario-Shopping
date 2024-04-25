<?php
session_start();

include("../../config/db.php");

if (isset($_POST['create_user'])){
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $clave_usuario = $_POST['clave_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $estado_usuario = 'pendiente';

    $categoria_cliente = '';
    if ($tipo_usuario == 'cliente') {
        $categoria_cliente = 'inicial';
    }

    $hashed_password = password_hash($clave_usuario, PASSWORD_DEFAULT); // Generar el hash de la contraseña

    $query = "INSERT INTO usuarios(
        nombre_usuario, 
        email, 
        clave_usuario,  
        tipo_usuario, 
        categoria_cliente,
        estado_usuario) 
        VALUES 
        (
            '$nombre_usuario', 
            '$email', 
            '$hashed_password',
            '$tipo_usuario',
            '$categoria_cliente',
            '$estado_usuario'
        )";

    $result = mysqli_query($conn, $query);

    if (!$result){
        $_SESSION['failed'] = true;
        header("Location: /bajorosario-shopping/src/views/registrar_usuario.php");
        exit(); 
    }


    // // Enviar email de confirmación
    // $to = $email;
    // $subject = "Confirmación de registro";
    // $message = "Hola $nombre_usuario, gracias por registrarte en nuestra plataforma. 
    // Tu cuenta se encuentra pendiente de aprobación. Te notificaremos cuando tu cuenta sea activada.";

    // // Encabezados
    // $header = 'From: pede@mail.com\r\n' .
    // 'Reply-To: pede@mail.com \r\n' .
    // 'X-Mailer: PHP/' . phpversion();

    // $mail = mail($to, $subject, $message, $header);

    // if ($mail){
    //     $_SESSION['mail_status'] = "Email de confirmación enviado correctamente";
    // } else {
    //     $_SESSION['mail_status'] = "Error al enviar el email de confirmación";
    // }


    // Establecer variable de sesión para indicar que el usuario se ha guardado con éxito
    $_SESSION['saved'] = true;
    $_SESSION['hash'] = $hashed_password;

    $_SESSION['success'] = true;

    // Redireccionar a registrar_usuario.php
    header("Location: /bajorosario-shopping/src/views/registrar_usuario.php");
    exit();

}

?>