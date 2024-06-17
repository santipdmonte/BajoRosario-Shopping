<?php

include("../../../config/db.php");
include("../../models/promocion.php");

if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    
    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['review_approve'] = true;
    $result = approve_promo($conn, $_POST['cod_promo']);

} else if (isset($_POST['action']) && $_POST['action'] == 'deny'){

    // Establecer variable de sesión para indicar que la promoción se ha actualizado con éxito
    session_start();
    $_SESSION['review_deny'] = true;
    $result = deny_promo($conn, $_POST['cod_promo']);

}

if (!$result){
    $_SESSION['review_failed'] = true;
}

header("Location: /bajorosario-shopping/admin/promociones");
exit();

?>