<?php
include("../../../config/db.php");

// Manejo de la acción para eliminar una novedad
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $cod_novedad = $_POST['cod_novedad'];

    $query = "UPDATE novedades SET estado_novedad = 'no activa' WHERE cod_novedad = $cod_novedad";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $query);
    $conn->close();

    if ($result) {
        session_start();
        $_SESSION['success'] = 'Novedad eliminada correctamente.';
    } else {
        session_start();
        $_SESSION['error'] = 'Error al eliminar la novedad';
    }
}

// Manejo de la acción para editar una novedad
else if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $cod_novedad = $_POST['cod_novedad'];

    // Redirigir a la página de edición de novedad con el parámetro cod_novedad
    header("Location: editar_novedad.php?cod_novedad=$cod_novedad");
    exit();
}

// Si se intenta acceder directamente a este script sin una acción válida
header("Location: /bajorosario-shopping/admin/novedades");
exit();
?>
