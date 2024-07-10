<?php
session_start();
include("../../../config/db.php");

include("../../controllers/update_files.php");
require '../../../aws-sdk-php/aws-autoloader.php';
$config = parse_ini_file('../../../config/config.ini', true);

if (isset($_POST['edit_local'])) {
    $cod_local = $_POST['cod_local'];
    $nombre_local = $_POST['nombre_local'];
    $ubicacion_local = $_POST['ubicacion_local'];
    $rubro_local = $_POST['rubro_local'];
    $cod_usuario = $_POST['cod_usuario'];
    // Puedes agregar más campos según sea necesario

    // Logica para subir imagen
    $query = "SELECT * FROM locales WHERE cod_local = $cod_local";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (isset($_FILES['imagen_local']) && $_FILES['imagen_local']['error'] === UPLOAD_ERR_OK) {

        $url = upload_img($_FILES['imagen_local'], $config);
        if ($url) {
            $url_logo = $url;
        } else {
            $warning = "Error: No pudimos cargar la imagen, vuelve a intentarlo mas tarde editando el local.";
            $url_logo = $row['url_logo'];
        };
        
    } else {
        $url_logo = $row['url_logo'];
    }

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
        $_SESSION['success'] = "Local editado correctamente.";
    } else {
        // Si hay un error en la consulta
        session_start();
        $_SESSION['error'] = "Error al editar la local.";
    }

    if (isset($warning)) {
        $_SESSION['warning'] = $warning;
    }

    
} 

// Redirigir de vuelta a la página principal de novedades
header("Location: /bajorosario-shopping/admin/locales");
exit();
?>
