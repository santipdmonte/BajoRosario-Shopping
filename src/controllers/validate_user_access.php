<?php

function validate_category_access($conn, $promo){

    if (isset($_SESSION['user'])){

        $tipo_usuario = $_SESSION['user'];

        if ($tipo_usuario == 'admin' || $tipo_usuario == 'dueno de local') {
            return true;
        }

        if ($tipo_usuario == 'cliente') {
            $categoria_cliente = $_SESSION['categoria_cliente'];
            $promo_categoria_minima = $promo['categoria_cliente'];

            if ($categoria_cliente == 'premium') {
                return true;
            }
            
            if ($promo_categoria_minima == 'medium' && $categoria_cliente == 'medium') {
                return true;
            }

            if ($promo_categoria_minima == 'inicial' && ($categoria_cliente == 'inicial' || $categoria_cliente == 'medium')) {
                return true;
            }
        }
    }

    return false;
}

function validate_admin_access($conn){

    if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
        return true;
    }
    return false;
}

?>