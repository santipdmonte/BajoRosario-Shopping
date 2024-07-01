<?php

function save_promo(
    $conn,
    $texto_promo, 
    $clave_promo,
    $fecha_desde_promo, 
    $fecha_hasta_promo,
    $categoria_cliente,
    $dias_semana,
    $cod_local
    ){

    $query = "INSERT INTO promociones(
        texto_promo, 
        clave_promo,
        fecha_desde_promo, 
        fecha_hasta_promo, 
        categoria_cliente, 
        dias_semana, 
        estado_promo, 
        cantidad_usos,
        cod_local) 
        VALUES 
        (
            '$texto_promo', 
            '$clave_promo',
            '$fecha_desde_promo', 
            '$fecha_hasta_promo',
            '$categoria_cliente',
            '$dias_semana',
            'pendiente',
            0,
            '$cod_local'
        )";

    $result = mysqli_query($conn, $query);

    return $result;
}

function get_promociones_by_client_category($conn){
    
    $categorias_permitidas = get_categorias_permitidas();
    

    $query = "
            SELECT * 
            FROM promociones 
            INNER JOIN locales ON promociones.cod_local = locales.cod_local 
            WHERE estado_promo = 'aprobada' 
                AND fecha_hasta_promo >= CURDATE() 
                AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
            ORDER BY fecha_hasta_promo ASC";
    $result = mysqli_query($conn, $query);

    return $result;
}

function get_total_promociones_by_client_category($conn) {

    $categorias_permitidas = get_categorias_permitidas();

    if (isset($_GET['rubro']) && $_GET['rubro']){
        $rubro = $_GET['rubro'];
        $query = "
            SELECT COUNT(*) AS total 
            FROM promociones
            INNER JOIN locales ON promociones.cod_local = locales.cod_local 
            WHERE estado_promo = 'aprobada' 
              AND fecha_hasta_promo >= CURDATE() 
              AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
              AND locales.rubro_local = '$rubro'
        ";
    } else {
        $query = "
            SELECT COUNT(*) AS total 
            FROM promociones 
            WHERE estado_promo = 'aprobada' 
              AND fecha_hasta_promo >= CURDATE() 
              AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
        ";
    }


    $result = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($result);
    return (int) $fila['total'];
}

function get_promociones_by_client_category_paginadas($conn, $inicio, $elementos_por_pagina) {

    $categorias_permitidas = get_categorias_permitidas();

    if (isset($_GET['rubro']) && $_GET['rubro']){
        $rubro = $_GET['rubro'];
        $query = "
            SELECT * 
            FROM promociones 
            INNER JOIN locales ON promociones.cod_local = locales.cod_local 
            WHERE estado_promo = 'aprobada' 
                AND fecha_hasta_promo >= CURDATE() 
                AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
                AND locales.rubro_local = '$rubro'
            ORDER BY fecha_hasta_promo ASC 
            LIMIT $inicio, $elementos_por_pagina
        ";
    } else {
        $query = "
            SELECT * 
            FROM promociones 
            INNER JOIN locales ON promociones.cod_local = locales.cod_local 
            WHERE estado_promo = 'aprobada' 
                AND fecha_hasta_promo >= CURDATE() 
                AND categoria_cliente IN ('".implode("','", $categorias_permitidas)."')
            ORDER BY fecha_hasta_promo ASC 
            LIMIT $inicio, $elementos_por_pagina
        ";
    }

    $result = mysqli_query($conn, $query);
    return $result;
}

function get_rubros($conn) {

    $query = 
    "SELECT DISTINCT categoria 
    FROM cateogrias_locales";
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

function get_promociones_by_dueno($conn) {

    $query = "
    SELECT * 
    FROM promociones 
    INNER JOIN locales ON promociones.cod_local = locales.cod_local
    WHERE estado_promo = 'aprobada'
        AND cod_usuario = " . $_SESSION['cod_usuario'] . " 
        AND fecha_hasta_promo >= CURDATE()
    ORDER BY fecha_hasta_promo DESC";

    return mysqli_query($conn, $query);
}

function delete_promo($conn, $cod_promo) {
    $query = "UPDATE promociones SET estado_promo = 'eliminado' WHERE cod_promo = " . $cod_promo;
    return mysqli_query($conn, $query);
}

function approve_promo($conn, $cod_promo) {
    $query = "UPDATE promociones SET estado_promo = 'aprobada' WHERE cod_promo = " . $cod_promo;
    return mysqli_query($conn, $query);
}

function deny_promo($conn, $cod_promo) {
    $query = "UPDATE promociones SET estado_promo = 'denegada' WHERE cod_promo = " . $cod_promo;
    return mysqli_query($conn, $query);
}

function validate_if_user_used_promo ($conn, $cod_promo, $cod_cliente) {
    $query = "
        SELECT * 
        FROM uso_promociones 
        WHERE cod_promo = '$cod_promo' 
            AND cod_cliente = '$cod_cliente'";
    $result = mysqli_query($conn, $query);

    return $result -> num_rows > 0;
}

// No implementado, implementado en un archivo promos_pendientes
// function promos_pendientes_aprobacion($conn){
//     include __DIR__ . '/../../config/db.php';
//     $sql = "SELECT COUNT(*) FROM promociones where estado_promo = 'pendiente'";
//     $result = $conn->query($sql);
//     $row = $result->fetch_row();
//     return $row[0];
// }