<?php

include("../../../config/db.php");

if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    
    $query = "UPDATE promociones SET estado_promo = 'aprobada' WHERE cod_promo = " . $_POST['cod_promo'];



    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['review_approve'] = true;

} else if (isset($_POST['action']) && $_POST['action'] == 'deny'){
    $query = "UPDATE promociones SET estado_promo = 'denegada' WHERE cod_promo = " . $_POST['cod_promo'];

    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['review_deny'] = true;

}

$result = mysqli_query($conn, $query);

if (!$result){
    $_SESSION['review_failed'] = true;
}

header("Location: /bajorosario-shopping/admin/promociones");
exit();

?>