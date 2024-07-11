<?php 

session_start();
session_destroy();
$_SESSION['login']=false;
    $_SESSION['cod_usuario']='';
    $_SESSION['nombre_usuario']='';
    $_SESSION['user']='';
    $_SESSION['categoria_cliente']='';

header('Location: /bajorosario-shopping/')

?>