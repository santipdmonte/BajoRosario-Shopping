<?php 

session_start();
$_SESSION['login']=false;
$_SESSION['cod_usuario']='';
$_SESSION['nombre_usuario']='';
$_SESSION['user']='';
$_SESSION['categoria_cliente']='';
session_destroy();

header('Location: /bajorosario-shopping/')

?>