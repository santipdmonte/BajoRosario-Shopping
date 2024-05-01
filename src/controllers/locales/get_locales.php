<?php

function get_locales(){
    include  __DIR__ . "/../../../config/db.php";

    $query = " SELECT * FROM locales";
    $locales = mysqli_query($conn, $query); 
    return $locales;
}