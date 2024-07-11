<?php


include __DIR__ . "/../../../config/db.php";




if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $cod_local = $_POST['cod_local'];

    $query = "DELETE FROM locales WHERE cod_local = $cod_local";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM promociones WHERE cod_local = $cod_local";
    $result = mysqli_query($conn, $query);

    // Establecer variable de sesión para indicar que el local se ha eliminado con éxito
    session_start();
    $_SESSION['success'] = 'Local eliminado correctamente, junto con sus promociones asociadas.';
} else if (isset($_POST['action']) && $_POST['action'] == 'edit'){
    // Manejo de la acción para editar una novedad
    
    $cod_local = $_POST['cod_local'];

    // Redirigir a la página de edición de novedad con el parámetro cod_novedad
    header("Location: editar_local.php?cod_local=$cod_local");
    exit();
}

// Si se intenta acceder directamente a este script sin una acción válida
header("Location: /bajorosario-shopping/admin/locales");
exit();
    
    
    




?>
