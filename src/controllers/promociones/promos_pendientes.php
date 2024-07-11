<?php

    function promos_pendientes_aprobacion(){
        include __DIR__ . '/../../../config/db.php';
        $sql = "SELECT COUNT(*) FROM promociones where estado_promo = 'pendiente'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }
?>