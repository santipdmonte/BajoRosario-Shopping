<?php

include  "../../config/db.php";
include "../models/usuario.php";
include "inicio_sesion.php";

if (isset($_GET['token'])){
    $token = $_GET['token'];

    $usuario = get_user_by_token($conn, $token);

    if (!$usuario){
        header('location: /bajorosario-shopping/');
        exit();
    } 

    if ($usuario['estado_usuario'] == 'activo'){
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