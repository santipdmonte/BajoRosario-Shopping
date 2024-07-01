<?php

include("../../../config/db.php");

if (isset($_POST['save_local'])){
    $nombre_local = $_POST['nombre_local'];
    $ubicacion_local = $_POST['ubicacion_local'];
    $rubro_local = $_POST['rubro_local'];
    $cod_usuario = $_POST['cod_usuario'];
    $url_logo = 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png';

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
            'url_logo',
            '$cod_usuario'
        )";

    $result = mysqli_query($conn, $query);

    if (!$result){
        $_SESSION['failed'] = true;

        // Redireccionar a admin_locales.php
        header("Location: /bajorosario-shopping/admin/locales");
        exit(); 
    }

    // Establecer variable de sesión para indicar que el local se ha guardado con éxito
    session_start();
    $_SESSION['saved'] = true;

    // Redireccionar a admin_locales.php
    header("Location: /bajorosario-shopping/admin/locales");
    exit();

}

?>