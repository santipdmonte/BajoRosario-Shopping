<?php


include __DIR__ . "/../../../config/db.php";




if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $cod_local = $_POST['cod_local'];

    $query = "DELETE FROM locales WHERE cod_local = $cod_local";

    // Establecer variable de sesión para indicar que el local se ha eliminado con éxito
    session_start();
    $_SESSION['deleted'] = true;
    $result = mysqli_query($conn, $query);
} else if (isset($_POST['action']) && $_POST['action'] == 'edit'){
    
    

}
/*$result = mysqli_query($conn, $query);

if (!$result){
    $_SESSION['failed'] = true;
}

header("Location: /bajorosario-shopping/admin/locales");
*/
?>
