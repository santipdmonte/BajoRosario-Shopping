<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajito Rosario | Promociones</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">

    
    <!-- Boostrap CSS -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="styles/index.css"> 
  </head>

  <?php
    $login = isset($_SESSION['login']);
    $dueno_local = isset($_SESSION['user']) && $_SESSION['user'] == 'dueno de local';
    $admin = isset($_SESSION['user']) && $_SESSION['user'] == 'admin';
  ?>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a href="/bajorosario-shopping/">
      <img src="assets/img/logo.png" alt="Bajo Rosario Logo" style="width: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/bajorosario-shopping/">Promociones</a>
        </li>

        <!-- Loged in -->
        <?php if ($login){ ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/bajorosario-shopping/novedades.php">Novedades</a>
            </li>
        <?php } ?>

        <!-- Dueño -->
        <?php if ($dueno_local) { ?>
          <li class="nav-item">
            <a class="nav-link active" href="/bajorosario-shopping/dueno_new_promo.php">New Promo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/bajorosario-shopping/dueno_manage_promo.php">Manage Promos</a>
          </li>
        <?php } ?>

        <!-- Admin -->
        <?php if ($admin) { ?>

          <?php
          include 'b_promos_pendientes.php';
          $promos_pendientes_aprobacion = promos_pendientes_aprobacion();

          include 'b_duenos_pendientes.php';
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

              <li><a class="dropdown-item d-flex gap-2" href="/bajorosario-shopping/admin_promo.php">Promociones
                <div>
                  <span class="badge text-bg-secondary nav-item">
                    <?php echo $promos_pendientes_aprobacion; ?>
                  </span>
                </div>
                </a>
              </li>
              <li><a class="dropdown-item d-flex gap-2" href="/bajorosario-shopping/admin_duenos.php">Dueños
                <div>
                  <span class="badge text-bg-secondary nav-item">
                    <?php echo $duenos_pendientes_aprobacion; ?>
                  </span>
                </div>
                </a>
              </li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin_novedades.php">Novedades</a></li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin_locales.php">Locales</a></li>
              <li><a class="dropdown-item" href="/bajorosario-shopping/admin_cliente_categorias.php">Categorias Cliente</a></li>
            </ul>
          </div>

        <?php } ?>
        <!-- End Admin -->

      </ul>

      <!-- Loged in -->
      <?php if ($login) { ?>

        <form class="d-flex me-3" role="search" action="b_local_search.php" method="POST">
          <input class="form-control me-2" type="search" placeholder="Buscar locales..." aria-label="Search" name='local'>
          <button class="btn btn-outline-success" type="submit" name="search_local">Buscar</button>
        </form>

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
              <li><a class="dropdown-item" href="#">Configuraciones</a></li>
              <li><a class="dropdown-item text-danger" href="/bajorosario-shopping/b_cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>

      <?php } else {?>
        <!-- Loged out -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/bajorosario-shopping/inicio_sesion.php">Iniciar Sesión</a> </li>
          <li class="nav-item"><a class="nav-link" href="/bajorosario-shopping/registrar_usuario.php">Registrarte</a></li>
        </ul>
      <?php } ?>

    </div>
  </div>
</nav>