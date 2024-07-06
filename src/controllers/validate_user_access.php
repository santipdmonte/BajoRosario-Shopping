<?php

function validate_category_access($conn, $promo){
    $valid_access = false;
    if (isset($_SESSION['user'])) {
        if ($_SESSION['categoria_cliente'] == $promo['categoria_cliente']) {
            $valid_access = true;
        }
    }
    return $valid_access;
}

function validate_admin_access($conn){
    $valid_access = false;
    if (isset($_SESSION['user'])) {
        if ($_SESSION['categoria_cliente'] == 'admin') {
            $valid_access = true;
        }
    }
    return $valid_access;
}

?>