<?php

function get_novedades_active(){
    include  __DIR__ . "/../../../config/db.php";

    $query = "
    SELECT * 
    FROM novedades 
    WHERE estado_novedad = 'activa'
        AND fecha_hasta_novedad >= CURDATE()";
    $novedades = mysqli_query($conn, $query); 
    return $novedades;
}

function get_novedades_by_client(){

    include  __DIR__ . "/../../../config/db.php";
    

    if (isset($_SESSION['categoria_cliente'])){
        $categoria_cliente = $_SESSION['categoria_cliente'];
    } else {
        return false;
    }
    
    if ($categoria_cliente == "premium"){
        $query = "
            SELECT * 
            FROM novedades 
            WHERE estado_novedad = 'activa' 
                AND fecha_hasta_novedad >= CURDATE() 
            ORDER BY fecha_hasta_novedad ASC";
        } elseif ($categoria_cliente == "medium"){

            $query = "
                SELECT * 
                FROM novedades 
                WHERE estado_novedad = 'activa' 
                    AND fecha_hasta_novedad >= CURDATE() 
                    AND categoria_cliente = '$categoria_cliente' OR categoria_cliente = 'inicial'
                ORDER BY fecha_hasta_novedad ASC";
        }else{
            $query = "
                SELECT * 
                FROM novedades 
                WHERE estado_novedad = 'activa' 
                    AND fecha_hasta_novedad >= CURDATE() 
                    AND categoria_cliente = '$categoria_cliente'
                ORDER BY fecha_hasta_novedad ASC";}

    
    $result = mysqli_query($conn, $query);

return $result;
}

?>