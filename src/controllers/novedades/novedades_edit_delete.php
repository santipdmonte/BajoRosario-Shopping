<?php

include("../../../config/db.php");

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    
    $query = "UPDATE novedades SET estado_novedad = 'no activa' WHERE cod_novedad = " . $_POST['cod_novedad'];



    // Establecer variable de sesión para indicar que la novedad se ha eliminado con éxito
    session_start();
    $_SESSION['deleted'] = true;

} else if (isset($_POST['action']) && $_POST['action'] == 'edit'){
    echo "TODO: Implementar la edición de novedades";
    exit();
    // $query = "UPDATE promociones SET estado_promo = 'denegada' WHERE cod_promo = " . $_POST['cod_promo'];

    // // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    // session_start();
    // $_SESSION['review_deny'] = true;

}

$result = mysqli_query($conn, $query);

if (!$result){
    $_SESSION['failed'] = true;
    
    // Redireccionar a admin_novedades.php
    header("Location: /bajorosario-shopping/src/views/admin/admin_novedades.php");
    exit(); 
}

// Redireccionar a admin_novedades.php
header("Location: /bajorosario-shopping/src/views/admin/admin_novedades.php");
exit();

?>