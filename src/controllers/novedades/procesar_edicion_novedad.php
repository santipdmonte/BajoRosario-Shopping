<?php
session_start(); 
include("../../../config/db.php");
include("../validate_dates.php");

if (isset($_POST['edit_novedad'])) {
    $cod_novedad = $_POST['cod_novedad'];
    $texto_novedad = $_POST['texto_novedad'];
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_desde_vieja = $_POST['fecha_desde_vieja'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $categoria_cliente = $_POST['categoria_cliente'];

    $current_date = date('Y-m-d');
    if ($fecha_desde_vieja < $current_date) {
        $_SESSION['error'] = validate_dates($current_date, $fecha_hasta);
    } else {
        $_SESSION['error'] = validate_dates($fecha_desde, $fecha_hasta);
    }

    if (isset($_SESSION['error'])){
        header("Location: editar_novedad.php?cod_novedad=$cod_novedad");
        exit();
    } 

    // Construir la consulta SQL para actualizar la novedad
    $query = "UPDATE novedades SET 
              texto_novedad = '$texto_novedad', 
              fecha_desde_novedad = '$fecha_desde', 
              fecha_hasta_novedad = '$fecha_hasta',
              categoria_cliente = '$categoria_cliente'
              WHERE cod_novedad = $cod_novedad";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $query);
    $conn->close();

    if ($result) {
        $_SESSION['success'] = "Novedad editada correctamente.";
    } else {
        $_SESSION['error'] = "Error al editar la novedad.";
    }

} 

// Redirigir de vuelta a la página principal de novedades
header("Location: /bajorosario-shopping/admin/novedades");
exit();

?>
