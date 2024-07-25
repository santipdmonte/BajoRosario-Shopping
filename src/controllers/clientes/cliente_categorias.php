<?php
ob_start();
include("../../../config/db.php");

session_start();

if (isset($_POST['save_changes'])) {
    
    $cod_categorias_array = $_POST['cod_categorias'];

    print_r($cod_categorias_array);

    $promo_minima_siguiente = 0;

    foreach ($cod_categorias_array as $categoria_cod){

        $promociones_minimas = $_POST['promociones_minimas_' . $categoria_cod];
        if (($promociones_minimas == "") || $promociones_minimas <= 0 || !is_numeric($promociones_minimas)){
            continue;
        }

        if ($promo_minima_anterior >= $promociones_minimas){

            $_SESSION['error'] = "Error: La cantidad de promociones minimas debe ser mayor a la categoria anterior";
            break;
        }

        $promo_minima_anterior = $promociones_minimas;

        $query = "UPDATE categorias_cliente SET promociones_minimas_adquiridas = $promociones_minimas WHERE cod_categoria =  $categoria_cod";
        $result = mysqli_query($conn, $query);
    }

} 

// if (!$result){
//     $_SESSION['error'] = true;
//     exit();
// }

if (isset($_SESSION['error']) && $_SESSION['error']){
    header("Location: /bajorosario-shopping/admin/categorias_cliente");
    exit();
}

$_SESSION['save_changes'] = true;
$conn->close();
header("Location: /bajorosario-shopping/admin/categorias_cliente");
exit();

ob_end_flush();

?>