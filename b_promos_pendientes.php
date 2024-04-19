<?php

    function promos_pendientes_aprobacion(){
        include 'b_db.php';
        $sql = "SELECT COUNT(*) FROM promociones where estado_promo = 'pendiente'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        return $row[0];
    }
?>