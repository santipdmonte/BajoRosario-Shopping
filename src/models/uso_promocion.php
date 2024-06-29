<?php

function save_uso_promo(
    $conn, $cod_promo, 
    $cod_cliente, 
    $fecha_uso_promo, 
    $estado){

        $query = "
                INSERT INTO 
                uso_promociones 
                    (cod_promo, 
                    cod_cliente, 
                    fecha_uso_promo, 
                    estado) 
                VALUES 
                    ('$cod_promo', 
                    '$cod_cliente', 
                    '$fecha_uso_promo', 
                    '$estado'
                )";
        
        $result = mysqli_query($conn, $query);
        
    }


?>