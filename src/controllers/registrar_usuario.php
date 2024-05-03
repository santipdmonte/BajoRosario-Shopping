<?php
session_start();

include("../../config/db.php");

require("script_enviar_email.php");

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

    $timestamp = time(); 
    $seed = 'bajitoenano'; 
    $hash_validacion = hash('sha256', $email . $timestamp . $seed); // Generar el hash de validación
 
    $query = "INSERT INTO usuarios(
        nombre_usuario, 
        email, 
        clave_usuario,  
        tipo_usuario, 
        categoria_cliente,
        estado_usuario,
        hash_validacion) 
        VALUES 
        (
            '$nombre_usuario', 
            '$email', 
            '$hashed_password',
            '$tipo_usuario',
            '$categoria_cliente',
            '$estado_usuario',
            '$hash_validacion'
        )";

    $result = mysqli_query($conn, $query);

    if (!$result){
        $_SESSION['failed'] = true;
        header("Location: /bajorosario-shopping/registrar_usuario");
        exit(); 
    }

    // Enviamos el mail de validación
    $result = sendMail($email, $hash_validacion);

    // Establecer variable de sesión para indicar que el usuario se ha guardado con éxito
    $_SESSION['saved'] = true;
    $_SESSION['hash'] = $hashed_password;

    $_SESSION['success'] = true;

    // Redireccionar a registrar_usuario.php
    header("Location: /bajorosario-shopping/registrar_usuario");
    exit();

}

?>