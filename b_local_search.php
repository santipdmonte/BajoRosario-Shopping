<?php

if (isset($_POST['search_local'])){
    header('Location: /bajorosario-shopping/local/' . $_POST['local']);
    exit();
}

?>