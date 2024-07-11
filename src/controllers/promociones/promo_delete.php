<?php

include("../../../config/db.php");
include("../../models/promocion.php");

if (isset($_POST['action']) && $_POST['action'] == 'delete') {

    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['deleted'] = true;
    $result = delete_promo($conn, $_POST['cod_promo']);
    $conn->close();

}


if (!$result){
    $_SESSION['failed'] = true;
}

if (isset($_POST['source']) && $_POST['source'] == 'dueno') {
    // Redireccionar a dueno_manage_promo.php
    header("Location: /bajorosario-shopping/dueño/manage_promo");
    exit();
} 

header("Location: /bajorosario-shopping/admin/promociones");
exit();

?>