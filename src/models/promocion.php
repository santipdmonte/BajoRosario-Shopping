<?php

function save_promo(
    $conn,
    $texto_promo, 
    $fecha_desde_promo, 
    $fecha_hasta_promo,
    $categoria_cliente,
    $dias_semana,
    $cod_local
    ){

    $query = "INSERT INTO promociones(
        texto_promo, 
        fecha_desde_promo, 
        fecha_hasta_promo, 
        categoria_cliente, 
        dias_semana, 
        estado_promo, 
        cod_local) 
        VALUES 
        (
            '$texto_promo', 
            '$fecha_desde_promo', 
            '$fecha_hasta_promo',
            '$categoria_cliente',
            '$dias_semana',
            'pendiente',
            '$cod_local'
        )";

    $result = mysqli_query($conn, $query);

    return $result;
}