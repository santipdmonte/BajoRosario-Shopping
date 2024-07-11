<?php

session_start();
include("../../../config/db.php");
include("../validate_dates.php");

if (isset($_POST['save_novedad'])){
    $texto_novedad = $_POST['texto_novedad'];
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $categoria_cliente = $_POST['categoria_cliente'];
    $estado_novedad = 'activa';

    $_SESSION['error'] = validate_dates($fecha_desde, $fecha_hasta);
    if (isset($_SESSION['error'])){
        header("Location: /bajorosario-shopping/admin/novedades");
        exit();
    } 

    $query = "INSERT INTO novedades(
        texto_novedad, 
        fecha_desde_novedad, 
        fecha_hasta_novedad, 
        categoria_cliente,
        estado_novedad) 
        VALUES 
        (
            '$texto_novedad', 
            '$fecha_desde', 
            '$fecha_hasta',
            '$categoria_cliente',
            '$estado_novedad'
        )";

    $result = mysqli_query($conn, $query);
    $conn->close();

    // Establecer variable de sesión para indicar que la promoción se ha guardado con éxito
    $_SESSION['success'] = 'Novedad guardada correctamente.';

    // Redireccionar a admin_novedades.php
    header("Location: /bajorosario-shopping/admin/novedades");
    exit();

}

?> 