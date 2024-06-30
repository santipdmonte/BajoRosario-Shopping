<?php
include("../../../config/db.php");

// Manejo de la acción para eliminar una novedad
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $cod_novedad = $_POST['cod_novedad'];

    $query = "UPDATE novedades SET estado_novedad = 'no activa' WHERE cod_novedad = $cod_novedad";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Establecer variable de sesión para indicar que la novedad se ha eliminado con éxito
        session_start();
        $_SESSION['deleted'] = true;
    } else {
        // Si hay un error en la consulta
        session_start();
        $_SESSION['failed'] = true;
    }

    // Redirigir de vuelta a la página principal de novedades
    header("Location: /bajorosario-shopping/admin/novedades");
    exit();
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
