<?php

function save_user(
    $nombre_usuario,
    $email,
    $hashed_password,
    $tipo_usuario,
    $categoria_cliente,
    $estado_usuario,
    $hash_validacion
    ){

    include("../../config/db.php");

    // Prepare the SQL statement with placeholders
    $query = "INSERT INTO usuarios (
        nombre_usuario, 
        email, 
        clave_usuario, 
        tipo_usuario, 
        categoria_cliente,
        estado_usuario,
        hash_validacion
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the actual values to the placeholders
    mysqli_stmt_bind_param($stmt, "sssssss", 
        $nombre_usuario, 
        $email, 
        $hashed_password, 
        $tipo_usuario, 
        $categoria_cliente, 
        $estado_usuario, 
        $hash_validacion
    );

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    if (!$result){
        $_SESSION['failed'] = true;
        header("Location: /bajorosario-shopping/");
        exit(); 
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


function find_user_by_email($email){
    include("../../config/db.php");

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($result);

    return $usuario;
}

function get_user_by_token($conn, $token){
    $query = "
        SELECT * 
        FROM usuarios 
        WHERE hash_validacion = '$token'";
    
    $usuario = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($usuario);

    return $usuario;
}

// No se esta utilizando, modificar en clientes/cliente_validar_cat.php
function update_user_category($cod_cliente, $cat_final){
    include("../../config/db.php");

    $query = "UPDATE usuarios SET categoria_cliente = '$cat_final' WHERE cod_usuario = '$cod_cliente'";
    $result = mysqli_query($conn, $query);
}