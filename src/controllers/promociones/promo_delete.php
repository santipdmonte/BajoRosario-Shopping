<?php

include("../../../config/db.php");

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    
    $query = "UPDATE promociones SET estado_promo = 'eliminado' WHERE cod_promo = " . $_POST['cod_promo'];

    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['deleted'] = true;
    $result = mysqli_query($conn, $query);

}


if (!$result){
    $_SESSION['failed'] = true;
    
    // Redireccionar a admin_promo.php
    header("Location: /bajorosario-shopping/index.php");
    exit(); 
}

if (isset($_POST['source']) && $_POST['source'] == 'dueno') {
    // Redireccionar a dueno_manage_promo.php
    header("Location: /bajorosario-shopping/dueño/manage_promo");
    exit();
} 

// Redireccionar a index.php
header("Location: /bajorosario-shopping/index.php");
exit();

?>