<?php
include("b_db.php");


if (isset($_POST['use_promo'])){

    $cod_promo = $_POST['cod_promo'];
    $cod_cliente = $_POST['cod_usuario'];
    $fecha_uso_promo = date("Y-m-d H:i:s");
    $estado = 'enviada';

    $query = "
        SELECT * 
        FROM uso_promociones 
        WHERE cod_promo = '$cod_promo' 
            AND cod_cliente = '$cod_cliente'";

    $result = mysqli_query($conn, $query);

    if ($result -> num_rows <= 0){
        $query2 = "
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
    
        $result2 = mysqli_query($conn, $query2);
    
        if (!$result2){
            exit("Hubo un error al intentar usar la promoción");
        }
    } 
 
    include ('b_cliente_validar_cat.php');
    validar_categoria($cod_cliente);

    header("Location: /bajorosario-shopping/promocion/". $cod_promo);
    exit();
}

?>