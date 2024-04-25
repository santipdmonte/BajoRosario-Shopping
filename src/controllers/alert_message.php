<?php

function alert_message(){
    if (isset($_SESSION['deleted']) && $_SESSION['deleted']) {
        echo '<div class="alert alert-success" role="alert"> Eliminado con éxito </div>';
        unset($_SESSION['deleted']);
    }

    if (isset($_SESSION['failed']) && $_SESSION['failed']) {
        echo '<div class="alert alert-danger" role="alert"> Error al realizar la accion</div>';
        unset($_SESSION['failed']);
    }
}

?>