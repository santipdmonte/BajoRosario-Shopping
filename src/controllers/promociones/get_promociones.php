<?php

// function get_promociones_by_client_category(){

//     include  __DIR__ . "/../../../config/db.php";

    
//     $categorias_permitidas = get_categorias_permitidas();
    

//     $query = "
//             SELECT * 
//             FROM promociones 
//             WHERE estado_promo = 'aprobada' 
//                 AND fecha_hasta_promo >= CURDATE() 
//                 AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
//             ORDER BY fecha_hasta_promo ASC";
//     $result = mysqli_query($conn, $query);

//     return $result;
// }

function get_total_promociones_by_client_category() {
    include __DIR__ . "/../../../config/db.php";

    $categorias_permitidas = get_categorias_permitidas();

    $query = "
        SELECT COUNT(*) AS total 
        FROM promociones 
        WHERE estado_promo = 'aprobada' 
          AND fecha_hasta_promo >= CURDATE() 
          AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
    ";

    $result = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($result);
    return (int) $fila['total'];
}

function get_promociones_by_client_category_paginadas($inicio, $elementos_por_pagina) {
    include __DIR__ . "/../../../config/db.php";

    $categorias_permitidas = get_categorias_permitidas();

    $query = "
        SELECT * 
        FROM promociones 
        WHERE estado_promo = 'aprobada' 
          AND fecha_hasta_promo >= CURDATE() 
          AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
        ORDER BY fecha_hasta_promo ASC 
        LIMIT $inicio, $elementos_por_pagina
    ";

    $result = mysqli_query($conn, $query);
    return $result;
}

function get_categorias_permitidas() {
    if (isset($_SESSION['categoria_cliente'])) {
        $categoria = $_SESSION['categoria_cliente'];
    } else {
        $categoria = 'inicial';
    }

    if ($categoria == 'inicial') {
        return ['inicial'];
    } else if ($categoria == 'medium') {
        return ['inicial', 'medium'];
    } else if ($categoria == 'premium') {
        return ['inicial', 'medium', 'premium'];
    }

    // Si el usuario no es cliente, puede ver todas las promociones
    if (isset($_SESSION['user']) && ($_SESSION['user'] != 'cliente')) {
        return ['inicial', 'medium', 'premium'];
    }

    return [];
}

?>