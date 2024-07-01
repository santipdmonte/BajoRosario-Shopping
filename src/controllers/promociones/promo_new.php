<?php

include("../../../config/db.php");
require("../../models/promocion.php");

if (isset($_POST['save_promo'])){
    $texto_promo = $_POST['texto_promo'];
    $fecha_desde_promo = $_POST['fecha_inicio'];
    $fecha_hasta_promo = $_POST['fecha_fin'];
    $categoria_cliente = $_POST['categoria_cliente'];
    $cod_local = $_POST['cod_local'];

    $clave_promo = substr(bin2hex(random_bytes(6)), 0, 6);

    $query = "SELECT * FROM locales WHERE cod_local = '$cod_local'";
    $local = mysqli_query($conn, $query);
    $result = false;
    // Validar que las fechas sean válidas y el local exista
    if ($local->num_rows != 0){
        if (!empty($fecha_desde_promo) && DateTime::createFromFormat('Y-m-d', $fecha_desde_promo) !== false){
            if (!empty($fecha_hasta_promo) && DateTime::createFromFormat('Y-m-d', $fecha_hasta_promo) !== false) {
                if ($fecha_desde_promo > $fecha_hasta_promo){
                    $error = "La fecha de inicio debe ser menor a la fecha de fin";
                } else {
                    $dias_semana = [0,0,0,0,0,0,0];
                    foreach ($_POST['dias'] as $dia) {
                        $dias_semana[$dia] = 1;
                    }
                    $dias_semana = json_encode($dias_semana); // Convertir el array a string

                    $result = save_promo($conn, $texto_promo, $clave_promo, $fecha_desde_promo, $fecha_hasta_promo, $categoria_cliente, $dias_semana, $cod_local);
                }
            } else { $error = "La fecha de fin no es válida"; }
        } else { $error = "La fecha de inicio no es válida"; }
    } else {$error = "El local no existe"; }

    
    session_start();
   
    if (!$result){
            
            $_SESSION['promo_failed'] = true;
            setcookie('promo_error', $error, time() + 60000, '/');
            
        } else{
            $_SESSION['promo_saved'] = true;
            
    }

   
   

    header("Location: /bajorosario-shopping/dueno/new_promo");
    

}
 
?>