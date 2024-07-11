<?php

function validate_dates($fecha_desde_promo, $fecha_hasta_promo){

    if (!empty($fecha_desde_promo) && DateTime::createFromFormat('Y-m-d', $fecha_desde_promo) !== false){
        if (!empty($fecha_hasta_promo) && DateTime::createFromFormat('Y-m-d', $fecha_hasta_promo) !== false) {

            if ($fecha_desde_promo < date("Y-m-d")) {
                return "Error: La fecha de inicio debe ser mayor a la fecha actual";
            }

            if ($fecha_hasta_promo < date("Y-m-d")) {
                return "Error: La fecha de fin debe ser mayor a la fecha actual";
            }
            
            if ($fecha_desde_promo > $fecha_hasta_promo){
                return "Error: La fecha de inicio debe ser menor a la fecha de fin";
            }

        } else { 
            return "Error: La fecha de fin no es válida";
           
        }
    } else { 
        return "Error: La fecha de inicio no es válida";       
    }

}

?>