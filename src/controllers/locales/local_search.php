<?php

if (isset($_POST['local'])){
    header('Location: /bajorosario-shopping/local/' . $_POST['local']);
    exit();
}

?>