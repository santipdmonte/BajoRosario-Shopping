<?php
session_start();

include("../../config/db.php");

require("script_enviar_email.php");

require("../models/usuario.php");

if (isset($_POST['create_user'])){
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $clave_usuario = $_POST['clave_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $estado_usuario = 'pendiente';

    // Verificar si el usuario ya existe
    $usuario = find_user_by_email($email);
    if ($usuario){
        $_SESSION['exists'] = true;
        header("Location: /bajorosario-shopping/registrar_usuario?email=$email");
        exit();
    }

    $categoria_cliente = '';
    if ($tipo_usuario == 'cliente') {
        $categoria_cliente = 'inicial';
    }

    $hashed_password = password_hash($clave_usuario, PASSWORD_DEFAULT); // Generar el hash de la contraseña

    $timestamp = time(); 
    $seed = 'bajitoenano'; 
    $hash_validacion = hash('sha256', $email . $timestamp . $seed); // Generar el hash de validación
 
    // Crear nuevo Usuario
    save_user($nombre_usuario, $email, $hashed_password, $tipo_usuario, $categoria_cliente, $estado_usuario, $hash_validacion);
    
    // Enviamos el mail de validación unicamente a los clientes
    if ($tipo_usuario == 'cliente')
        $result = sendMail($email, $hash_validacion);

    // Establecer variable de sesión para indicar que el usuario se ha guardado con éxito
    $_SESSION['saved'] = true;
    $_SESSION['hash'] = $hashed_password; // TODO: Eliminar esta variable de sesión, ver si se usa en algun lado
    $_SESSION['success'] = true;

    // Redireccionar a registrar_usuario.php
    header("Location: /bajorosario-shopping/registrar_usuario");
    exit();

}

?>