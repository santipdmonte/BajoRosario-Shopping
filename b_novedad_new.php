<?php

include("b_db.php");

if (isset($_POST['save_novedad'])){
    $texto_novedad = $_POST['texto_novedad'];
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $estado_novedad = 'activa';

    $query = "INSERT INTO novedades(
        texto_novedad, 
        fecha_desde_novedad, 
        fecha_hasta_novedad, 
        tipo_usuario,
        estado_novedad) 
        VALUES 
        (
            '$texto_novedad', 
            '$fecha_desde', 
            '$fecha_hasta',
            '$tipo_usuario',
            '$estado_novedad'
        )";

    $result = mysqli_query($conn, $query);

    if (!$result){
        $_SESSION['failed'] = true;

        // Redireccionar a admin_novedades.php
        header("Location: admin_novedades.php");
        exit(); 
    }

    // Establecer variable de sesión para indicar que la promoción se ha guardado con éxito
        session_start();
        $_SESSION['saved'] = true;

        // Redireccionar a admin_novedades.php
        header("Location: admin_novedades.php");
        exit();

}

?>