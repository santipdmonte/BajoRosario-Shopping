<?php

include  "../../config/db.php";
include "inicio_sesion.php";

if (isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "
        SELECT * 
        FROM usuarios 
        WHERE hash_validacion = '$token'";
    
    $usuario = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($usuario);

    if (!$usuario){
        echo "Usuario no encontrado";
        header('location: /bajorosario-shopping/inicio_sesion/sdfa');
        exit();
    } 

    if ($usuario['estado_usuario'] == 'activo'){
        echo "Usuario ya activo";
        header('location: /bajorosario-shopping/inicio_sesion?email='.$usuario['email']);
        exit();
    } 

    if ($usuario['estado_usuario'] == 'pendiente'){
        $query = "
            UPDATE usuarios 
            SET estado_usuario = 'activo' 
            WHERE hash_validacion = '$token'";
        mysqli_query($conn, $query);

        // Validar si ya hay una sesion activa, en ese caso destruirla
        if (isset($_SESSION['login'])){
            session_destroy();
            session_start();
        }
        iniciar_sesion_validado($usuario);
    }

    header('location: /bajorosario-shopping/inicio_sesion');
    exit();
    
}