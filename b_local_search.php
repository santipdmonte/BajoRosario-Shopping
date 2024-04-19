<?php

if (isset($_POST['search_local'])){
    header('Location: /CRUD/local/' . $_POST['local']);
    exit();
}

?>