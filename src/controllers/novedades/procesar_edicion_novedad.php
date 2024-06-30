<?php
include("../../../config/db.php");

if (isset($_POST['edit_novedad'])) {
    $cod_novedad = $_POST['cod_novedad'];
    $texto_novedad = $_POST['texto_novedad'];
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $categoria_cliente = $_POST['categoria_cliente'];
    // Puedes agregar más campos según sea necesario

    // Construir la consulta SQL para actualizar la novedad
    $query = "UPDATE novedades SET 
              texto_novedad = '$texto_novedad', 
              fecha_desde_novedad = '$fecha_desde', 
              fecha_hasta_novedad = '$fecha_hasta',
              categoria_cliente = '$categoria_cliente'
              WHERE cod_novedad = $cod_novedad";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Establecer variable de sesión para indicar que la novedad se ha editado con éxito
        session_start();
        $_SESSION['edited'] = true;
        $_SESSION['message'] = "Novedad editada correctamente.";
    } else {
        // Si hay un error en la consulta
        session_start();
        $_SESSION['edit_failed'] = true;
        $_SESSION['message'] = "Error al editar la novedad.";
    }

    // Redirigir de vuelta a la página principal de novedades
    header("Location: /bajorosario-shopping/admin/novedades");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin una acción válida
    header("Location: /bajorosario-shopping/admin/novedades");
    exit();
}
?>
