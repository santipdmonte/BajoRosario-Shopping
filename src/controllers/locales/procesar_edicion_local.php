<?php
include("../../../config/db.php");

if (isset($_POST['edit_local'])) {
    $cod_local = $_POST['cod_local'];
    $nombre_local = $_POST['nombre_local'];
    $ubicacion_local = $_POST['ubicacion_local'];
    $rubro_local = $_POST['rubro_local'];
    $cod_usuario = $_POST['cod_usuario'];
    $url_logo = $_POST['url_logo'];
    // Puedes agregar más campos según sea necesario

    // Construir la consulta SQL para actualizar la novedad
    $query = "UPDATE locales SET 
                nombre_local = '$nombre_local',
                ubicacion_local = '$ubicacion_local',
                rubro_local = '$rubro_local',
                cod_usuario = '$cod_usuario',
                url_logo = '$url_logo'
              WHERE cod_local = $cod_local";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Establecer variable de sesión para indicar que la novedad se ha editado con éxito
        session_start();
        $_SESSION['edited'] = true;
        $_SESSION['message'] = "Local editada correctamente.";
    } else {
        // Si hay un error en la consulta
        session_start();
        $_SESSION['edit_failed'] = true;
        $_SESSION['message'] = "Error al editar la local.";
    }

    // Redirigir de vuelta a la página principal de novedades
    header("Location: /bajorosario-shopping/admin/locales");
    exit();
} else {
    // Si se intenta acceder directamente a este script sin una acción válida
    header("Location: /bajorosario-shopping/admin/locales");
    exit();
}
?>
