<?php

    function duenos_pendientes_aprobacion(){
        include 'b_db.php';
        $sql = "SELECT COUNT(*) FROM usuarios where tipo_usuario = 'dueno de local' AND estado_usuario = 'pendiente'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        return $row[0];
    }
?>