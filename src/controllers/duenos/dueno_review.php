<?php
session_start();

include("../../../config/db.php");

if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    
    $query = "UPDATE usuarios SET estado_usuario = 'activa' WHERE cod_usuario = " . $_POST['cod_usuario']; 
    $_SESSION['review_approve'] = true;

} else if (isset($_POST['action']) && $_POST['action'] == 'deny'){

    $query = "UPDATE usuarios SET estado_usuario = 'baja' WHERE cod_usuario = " . $_POST['cod_usuario'];
    $_SESSION['review_deny'] = true;

}

$result = mysqli_query($conn, $query);

if (!$result){
    $_SESSION['review_failed'] = true;

}

$conn->close();
header("Location: /bajorosario-shopping/admin/duenos");
exit();

?>