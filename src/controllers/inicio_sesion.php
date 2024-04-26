<?php
session_start();

include  "../../config/db.php";

if (isset($_POST['valid_user'])){
    $email = $_POST['email'];
    $contrasena_ingresada = $_POST['clave_usuario']; // Contraseña ingresada por el usuario durante el inicio de sesión

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($result);

    if (!$result){
        echo "Usuario no encontrado";
        exit();
    }

    $hashed_password = $result["clave_usuario"];

    if (password_verify($contrasena_ingresada, $hashed_password)) {
        // La contraseña es válida
        if ($result["estado_usuario"] == "pendiente"){
            $_SESSION['not_aprove']=true;
            header('location: /bajorosario-shopping/inicio_sesion');
            exit();
        }
        
        $_SESSION['login']=true;
        $_SESSION['cod_usuario']=$result["cod_usuario"];
        $_SESSION['nombre_usuario']=$result["nombre_usuario"];
        $_SESSION['user']=$result["tipo_usuario"];
        if ($result["tipo_usuario"] == "cliente"){
            $_SESSION['categoria_cliente']=$result["categoria_cliente"];
        }
        header('location: /bajorosario-shopping/');
    } else {
        // La contraseña no es válida
        $_SESSION['not_valid_password']=true;
        header('location: /bajorosario-shopping/inicio_sesion');
    }

}

?>