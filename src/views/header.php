<?php session_start(); ?>
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
  </head>


<body>
  

  <?php
    $login = isset($_SESSION['login']);
    $cliente = isset($_SESSION['user']) && $_SESSION['user'] == 'cliente';
    $dueno_local = isset($_SESSION['user']) && $_SESSION['user'] == 'dueno de local';
    $admin = isset($_SESSION['user']) && $_SESSION['user'] == 'admin';
  ?>

  <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a href="/bajorosario-shopping/">
      <img src="https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png" class="mx-2" alt="Bajo Rosario Logo" style="width: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/bajorosario-shopping/promociones">Promociones</a>
        </li>

        <!-- Cliente - Log In -->
        <?php if ($cliente){ ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/bajorosario-shopping/novedades">Novedades</a>
            </li>
        <?php } ?>

        <!-- Dueño -->
        <?php if ($dueno_local) { ?>
          <li class="nav-item">
            <a class="nav-link active" href="/bajorosario-shopping/dueno/new_promo">Nueva Promo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/bajorosario-shopping/dueño/manage_promo">Gestionar Promos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/bajorosario-shopping/dueño/reportes">Reportes</a> 
          </li>

        <?php } ?>

        <!-- Admin -->
        <?php if ($admin) { ?>

          <?php
          include __DIR__ . '../../controllers/promociones/promos_pendientes.php';
          $promos_pendientes_aprobacion = promos_pendientes_aprobacion();

          include __DIR__ . '../../controllers/duenos/duenos_pendientes.php';
          $duenos_pendientes_aprobacion = duenos_pendientes_aprobacion();

          $admin_badge = true;
          if (!$promos_pendientes_aprobacion || !$duenos_pendientes_aprobacion) {
            $admin_badge = false;
          }
          ?>

          <div class="text-white dropdown">

            <a class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin              
            </a>

            <ul class="dropdown-menu">

              <li><a class="dropdown-item d-flex gap-2" href="/bajorosario-shopping/admin/promociones">Promociones
                <div>
                  <span class="badge text-bg-secondary nav-item">
                    <?php echo $promos_pendientes_aprobacion; ?>
                  </span>
                </div>
                </a>
              </li>
              <li><a class="dropdown-item d-flex gap-2" href="/bajorosario-shopping/admin/duenos">Dueños
                <div>
                  <span class="badge text-bg-secondary nav-item">
                    <?php echo $duenos_pendientes_aprobacion; ?>
                  </span>
                </div>
                </a>
              </li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin/novedades">Novedades</a></li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin/locales">Locales</a></li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin/categorias_cliente">Categorias Cliente</a></li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin/reportes">Reportes</a></li>
            </ul>
          </div>

        <?php } ?>
        <!-- End Admin -->

      </ul>

      <!-- Loged in -->
      <?php if ($login) { ?>

        <?php include('buscador.php')?>

        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              if (isset($_SESSION['nombre_usuario'])){
                echo ucfirst($_SESSION['nombre_usuario']);
              }
            ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/bajorosario-shopping/cuenta">Cuenta</a></li>
              <li><a class="dropdown-item text-danger" href="/bajorosario-shopping/src/controllers/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>

      <?php } else {?>
        <!-- Loged out -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/bajorosario-shopping/inicio_sesion">Iniciar Sesión</a> </li>
        </ul>
      <?php } ?>

    </div>
  </div>
</nav>