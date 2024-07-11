<?php
ob_start();
session_start();
include("../../../config/db.php");
include("../../controllers/update_files.php");
require '../../../aws-sdk-php/aws-autoloader.php';
$config = parse_ini_file('../../../config/config.ini', true);

if (isset($_POST['save_local'])){
    $nombre_local = $_POST['nombre_local'];
    $ubicacion_local = $_POST['ubicacion_local'];
    $rubro_local = $_POST['rubro_local'];
    $cod_usuario = $_POST['cod_usuario'];

    // Logica para subir imagen
    if (isset($_FILES['imagen_local']) && $_FILES['imagen_local']['error'] === UPLOAD_ERR_OK) {
        $url = upload_img($_FILES['imagen_local'], $config);
        if ($url) {
            $url_logo = $url;
        } else {
            $warning = "Error: No pudimos cargar la imagen, vuelve a intentarlo mas tarde editando el local.";
            $url_logo = 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png';
        };
    } else {
        $warning = "Error: No pudimos cargar la imagen, vuelve a intentarlo mas tarde editando el local..";
        $url_logo = 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png';
    }

    $query = "INSERT INTO locales(
        nombre_local,
        ubicacion_local,
        rubro_local,
        url_logo,
        cod_usuario) 
        VALUES 
        (
            '$nombre_local',
            '$ubicacion_local',
            '$rubro_local',
            '$url_logo',
            '$cod_usuario'
        )";

    $result = mysqli_query($conn, $query);
    $conn->close();

    if (!$result){
        $_SESSION['failed'] = true;

        // Redireccionar a admin_locales.php
        header("Location: /bajorosario-shopping/admin/locales");
        exit(); 
    }

    // Establecer variable de sesión para indicar que el local se ha guardado con éxito
    $_SESSION['saved'] = true;
    if (isset($warning) && $warning != ""){
        $_SESSION['warning'] = $warning;
    }

    // Redireccionar a admin_locales.php
    header("Location: /bajorosario-shopping/admin/locales");
    exit();

}

// Enviar el contenido del buffer y limpiar el buffer
ob_end_flush();

?>