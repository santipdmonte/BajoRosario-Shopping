<?php  
include __DIR__ . "/header.php";
include "../../config/db.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bajito Rosario | Promociones</title>
  <link rel="icon" type="image/x-icon" href="https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/favicon.ico">

  
  <!-- Boostrap CSS -->    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="stylesheet" href="/bajorosario-shopping/styles/index.css"> 
  <style>
    a {
      text-decoration: none;
    }
  </style>
  </head>


<body>
  

  <?php
  $login = isset($_SESSION['login']);
  $cliente = isset($_SESSION['user']) && $_SESSION['user'] == 'cliente';
  $dueno_local = isset($_SESSION['user']) && $_SESSION['user'] == 'dueno de local';
  $admin = isset($_SESSION['user']) && $_SESSION['user'] == 'admin';
  ?>

<div class="">
  
  <?php if ($cliente){ ?>
      <h1 style="margin-left: 10px;" >CLIENTE</h1>
      <?php } else if ($dueno_local) { ?>
        <h1 style="margin-left: 10px;">DUENO LOCAL</h1> <?php
      }
      else  if ($admin){ ?>
        <h1 style="margin-left: 10px;">ADMIN</h1>
        <?php }
         ?>

  
  <ul>
    <li>
      <a href="/bajorosario-shopping/">Inicio</a>
    </li>
  </ul>
  <ul style="margin-left: 10px;">
    <li>
      <a href="/bajorosario-shopping/promociones">Promociones</a>
    </li>

  
  <!-- Cliente - Log In -->
  <?php if ($cliente){ ?>
    <li>
      <a href="/bajorosario-shopping/novedades">Novedades</a>
    </li>
  <?php } ?>

  <!-- Dueño -->
  <?php if ($dueno_local) { ?>
    <li>
    <a href="/bajorosario-shopping/dueno/new_promo">Nueva Promo</a>
    </li>
    <li>
    <a href="/bajorosario-shopping/dueño/manage_promo">Gestionar Promos</a>
    </li>
    <li>
    <a href="/bajorosario-shopping/dueño/reportes">Reportes</a> 
    </li>

  <?php } ?>

  <!-- Admin -->
  <?php if ($admin) { ?>
    <div>
      <li><a href="/bajorosario-shopping/admin/promociones"> Gestionar Promociones</a></li>

      <li><a href="/bajorosario-shopping/admin/duenos"> Gestionar Dueños</a></li>

      <li><a href="/bajorosario-shopping/admin/novedades">Novedades</a></li>

      <li><a href="/bajorosario-shopping/admin/locales">Locales</a></li>

      <li><a href="/bajorosario-shopping/admin/categorias_cliente">Categorias Cliente</a></li>
      
      <li><a href="/bajorosario-shopping/admin/reportes">Reportes</a></li>
    </ul>
    </div>

  <?php } ?>
  <!-- End Admin -->

  </ul>
</div>
    


  </div>
  </div>
  <?php include ("footer.php") ?>
