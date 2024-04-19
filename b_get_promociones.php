<?php

function get_promociones_by_client_category(){

    include("b_db.php");

    if (isset($_SESSION['categoria_cliente'])){
        $categoria = $_SESSION['categoria_cliente'];
    } else {
        $categoria = 'inicial';
    }

    if ($categoria == 'inicial'){
        $categorias_permitidas = ['inicial'];
    } else if ($categoria == 'medium'){
        $categorias_permitidas = ['inicial', 'medium'];
    } else if ($categoria == 'premium'){
        $categorias_permitidas = ['inicial', 'medium', 'premium'];
    }

    if (isset($_SESSION['user']) && ($_SESSION['user'] != 'cliente')){
        $categorias_permitidas = ['inicial', 'medium', 'premium'];
    } 

    $query = "
            SELECT * 
            FROM promociones 
            WHERE estado_promo = 'aprobada' 
                AND fecha_hasta_promo >= CURDATE() 
                AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
            ORDER BY fecha_hasta_promo ASC";
    $result = mysqli_query($conn, $query);

    return $result;
}

?>