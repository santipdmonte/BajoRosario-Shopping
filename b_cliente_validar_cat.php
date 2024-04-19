<?php


function validar_categoria($cod_cliente){
    include("b_db.php");

    $cod_cliente = 25;

    $query = "
        SELECT * 
        FROM uso_promociones 
        WHERE cod_cliente = '$cod_cliente'";

    $result = mysqli_query($conn, $query);
    $cant_promo_usadas = $result -> num_rows;

    $query = "
        SELECT * 
        FROM categorias_cliente";

    $result = mysqli_query($conn, $query);

    $cat_final = 'inicial';
    foreach ($result as $categoria){
        $promociones_minimas = $categoria['promociones_minimas_adquiridas'];

        if ($cant_promo_usadas >= $promociones_minimas){
            $cat_final = $categoria['categoria'];
        }
    }

    // Se podria mejorar modificando la base de datos, guardando el cod_categoria.
    $query = "
            UPDATE usuarios
            SET categoria_cliente = '$cat_final'
            WHERE cod_usuario = '$cod_cliente'";

            mysqli_query($conn, $query);

    echo $cat_final;



}


?>