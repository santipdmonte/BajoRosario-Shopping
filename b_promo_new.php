<?php

include("b_db.php");

if (isset($_POST['save_promo'])){
    $texto_promo = $_POST['texto_promo'];
    $fecha_desde_promo = $_POST['fecha_inicio'];
    $fecha_hasta_promo = $_POST['fecha_fin'];
    $categoria_cliente = $_POST['categoria_cliente'];
    $cod_local = $_POST['cod_local'];

    // Recorrer el array de días seleccionados y activar los dias seleccionados
    $dias_semana = [0,0,0,0,0,0,0];
    foreach ($_POST['dias'] as $dia) {
        $dias_semana[$dia] = 1;
    }
    // Convertir el array a string
    $dias_semana = json_encode($dias_semana);


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

    if (!$result){
        $_SESSION['promo_failed'] = true;
        // Redireccionar a dueno_new_promo.php

        header("Location: dueno_new_promo.php");
        exit(); 
    }

    // Establecer variable de sesión para indicar que la promoción se ha guardado con éxito
        session_start();
        $_SESSION['promo_saved'] = true;

        // Redireccionar a dueno_new_promo.php
        header("Location: dueno_new_promo.php");
        exit();

}

?>