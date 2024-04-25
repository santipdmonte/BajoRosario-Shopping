<?php

function get_novedades_by_user(){

    include  __DIR__ . "/../../../config/db.php";

if (isset($_SESSION['user'])){
    $tipo_usuario = $_SESSION['user'];
} else {
    header("Location: /bajorosario-shopping/index.php");
    exit();
}
 
$query = "
        SELECT * 
        FROM novedades 
        WHERE estado_novedad = 'activa' 
            AND fecha_hasta_novedad >= CURDATE() 
            AND tipo_usuario = '$tipo_usuario'
        ORDER BY fecha_hasta_novedad ASC";
$result = mysqli_query($conn, $query);

return $result;
}

?>