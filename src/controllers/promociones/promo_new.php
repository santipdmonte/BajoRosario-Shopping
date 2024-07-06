<?php

session_start();
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
                    $_SESSION['error'] = "Error: La fecha de inicio debe ser menor a la fecha de fin";
                    header("Location: /bajorosario-shopping/dueno/new_promo");
                    exit();

                } else {
                    $dias_semana = [0,0,0,0,0,0,0];
                    foreach ($_POST['dias'] as $dia) {
                        $dias_semana[$dia] = 1;
                    }
                    $dias_semana = json_encode($dias_semana); // Convertir el array a string

                    $result = save_promo($conn, $texto_promo, $clave_promo, $fecha_desde_promo, $fecha_hasta_promo, $categoria_cliente, $dias_semana, $cod_local);
                }

            } else { 
                $_SESSION['error'] = "Error: La fecha de fin no es válida";
                header("Location: /bajorosario-shopping/dueno/new_promo");
                exit(); 
            }
        } else { 
            $_SESSION['error'] = "Error: La fecha de inicio no es válida"; 
            header("Location: /bajorosario-shopping/dueno/new_promo");
            exit();
        }
    } else {
        $_SESSION['error'] = "Error: El local seleccionado no existe"; 
    }

    
   
    if (!isset($_SESSION['error'])){ 
        $_SESSION['promo_saved'] = true;    
    }

   
   

    header("Location: /bajorosario-shopping/dueno/new_promo");
    

}
 
?>