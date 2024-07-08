<?php

if (isset($_GET['local'])){
    header('Location: /bajorosario-shopping/local/' . $_GET['local']);
    exit();
}

?>