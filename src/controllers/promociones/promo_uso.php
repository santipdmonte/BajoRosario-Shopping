<?php
include("../../../config/db.php");
include("../../models/promocion.php");
include("../../models/uso_promocion.php");

if (isset($_POST['use_promo'])){

    $cod_promo = $_POST['cod_promo'];
    $cod_cliente = $_POST['cod_usuario'];
    $fecha_uso_promo = date("Y-m-d H:i:s");
    $estado = 'enviada';

    if (!validate_if_user_used_promo ($conn, $cod_promo, $cod_cliente)){
        
        $result = save_uso_promo($conn, $cod_promo, $cod_cliente, $fecha_uso_promo, $estado);
    
    } 
 
    include ('../clientes/cliente_validar_cat.php');
    validar_categoria($cod_cliente);

    $conn->close();
    header("Location: /bajorosario-shopping/promocion/". $cod_promo);
    exit();
}

?>