<?php
ob_start();
include("../../../config/db.php");

session_start();

if (isset($_POST['save_changes'])) {
    
    $cod_categorias_array = $_POST['cod_categorias'];

    print_r($cod_categorias_array);

    foreach ($cod_categorias_array as $categoria_cod){
        $promociones_minimas = $_POST['promociones_minimas_' . $categoria_cod];
        if (($promociones_minimas == "") || $promociones_minimas <= 0 || !is_numeric($promociones_minimas)){
            continue;
        }

        $query = "UPDATE categorias_cliente SET promociones_minimas_adquiridas = $promociones_minimas WHERE cod_categoria =  $categoria_cod";
        $result = mysqli_query($conn, $query);
    }

} 

// if (!$result){
//     $_SESSION['error'] = true;
//     exit();
// }

ob_end_flush();
$_SESSION['save_changes'] = true;
$conn->close();
header("Location: /bajorosario-shopping/admin/categorias_cliente");
exit();

?>