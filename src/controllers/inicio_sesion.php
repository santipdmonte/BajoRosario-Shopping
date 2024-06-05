<?php
session_start();

include  "../../config/db.php";

require("../models/usuario.php");

if (isset($_POST['valid_user'])){
    $email = $_POST['email'];
    $contrasena_ingresada = $_POST['clave_usuario']; // Contraseña ingresada por el usuario durante el inicio de sesión

    $usuario = find_user_by_email($email);

    if (!$usuario){
        $_SESSION['usuario_no_encontrado'] = true;
        header("Location: /bajorosario-shopping/inicio_sesion?email=$email");
        exit();
    }

    $hashed_password = $usuario["clave_usuario"];

    if (password_verify($contrasena_ingresada, $hashed_password)) {
        // La contraseña es válida
        if ($usuario["estado_usuario"] == "pendiente"){
            $_SESSION['not_aprove']=true;
            header('location: /bajorosario-shopping/inicio_sesion');
            exit();
        }

        iniciar_sesion_validado($usuario);
    }

    // La contraseña no es válida
    $_SESSION['not_valid_password']=true;
    header('location: /bajorosario-shopping/inicio_sesion');
}

function iniciar_sesion_validado($usuario){
    // TODO: Validar categoria del cliente segun cantidad promociones
    $_SESSION['login']=true;
    $_SESSION['cod_usuario']=$usuario["cod_usuario"];
    $_SESSION['nombre_usuario']=$usuario["nombre_usuario"];
    $_SESSION['user']=$usuario["tipo_usuario"];
    if ($usuario["tipo_usuario"] == "cliente"){
        $_SESSION['categoria_cliente']=$usuario["categoria_cliente"];
    }
    header('location: /bajorosario-shopping/');
    exit();
}

?>