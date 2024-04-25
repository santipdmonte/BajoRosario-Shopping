<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <?php
    // Verificar si la variable de sesión está establecida para mostrar el toast
    if (isset($_SESSION['saved']) && $_SESSION['saved']) {
        // Si la promoción se ha guardado correctamente, muestra el mensaje
        echo '<div class="alert alert-success" role="alert"> La novedad se guardo con éxito </div>';
        unset($_SESSION['saved']);
    }
    if (isset($_SESSION['deleted']) && $_SESSION['deleted']) {
        // Si la promoción se ha guardado correctamente, muestra el mensaje
        echo '<div class="alert alert-success" role="alert"> La novedad se elimino con éxito </div>';
        unset($_SESSION['deleted']);
    }
    if (isset($_SESSION['failed']) && $_SESSION['failed']) {
        // Si la promoción no se pudo guardar, muestra el mensaje
        echo '<div class="alert alert-danger" role="alert"> Error</div>';
        unset($_SESSION['failed']);
    }
    ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nueva Novedad
    </button>

    <!-- New novedad form -->
    <div class="card" style="width: 40rem;" hidden>
        <div class="card-body">

            <form action="/bajorosario-shopping/src/controllers/novedades/novedad_new.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Texto Novedad</label>
                    <input type="text" name="texto_novedad" class="form-control" autofocus required>
                </div>

                <!-- Input Fecha Ini -->
                <div class="mb-3">
                    <label for="fechaInicio" class="form-label">Novedad Desde</label>
                    <input type="date" class="form-control" name="fecha_desde" required>
                </div>

                <!-- Input fecha Hasta -->
                <div class="mb-3">
                    <label for="fechaFin" class="form-label">Novedad Hasta</label>
                    <input type="date" class="form-control" name="fecha_hasta" required>
                </div>
                
                <!-- Input Categoria Cliente -->
                <div class="mb-3">
                    <label for="selectOpciones" class="form-label">Tipo de Usuario</label>
                    <select class="form-select" id="selectOpciones" name="tipo_usuario">
                        <option value="cliente">Cliente</option>
                        <option value="dueno de local">Dueño de Local</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" name="save_novedad">    

            </form>

        </div>
    </div>

    <!-- List Novedades -->
    <!-- TODO: Validar las fechas de las promo, hacer ver graficamente cuando una promo ya expiro -->

<div 
    class="container p-4" 
    style="
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center;">

    <?php
    
    // Verificar si la variable de sesión está establecida para mostrar el toast
    if (isset($_SESSION['review_approve']) && $_SESSION['review_approve']) {
        // Si la promoción se ha guardado correctamente, muestra el mensaje
        echo '<div class="alert alert-success" role="alert"> La promoción se aprobo con éxito </div>';
        unset($_SESSION['review_approve']);
    }
    if (isset($_SESSION['review_deny']) && $_SESSION['review_deny']) {
        // Si la promoción se ha guardado correctamente, muestra el mensaje
        echo '<div class="alert alert-success" role="alert"> La promoción se denego con éxito </div>';
        unset($_SESSION['review_deny']);
    }
    if (isset($_SESSION['review_failed']) && $_SESSION['review_failed']) {
        // Si la promoción no se pudo guardar, muestra el mensaje
        echo '<div class="alert alert-danger" role="alert"> Error al aprobar/denegar la promoción</div>';
        unset($_SESSION['review_saved']);
    }
    ?>

    <table class="table table-dark table-striped table-hover shadow">

    <thead>
        <tr>
            <th scope="col">Novedad</th>
            <th scope="col">Desde - Hasta</th>
            <th scope="col">Usuario</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>

    <?php 
    // TODO: filtrar por fecha
    $query = "SELECT * FROM novedades WHERE estado_novedad = 'activa'";
    $result = mysqli_query($conn, $query); 

    while($row = mysqli_fetch_array($result)){ ?>

        <!-- Itero por cada fila de promociones en la DB -->
        <tbody>
            <tr>
            <td><?php echo $row['texto_novedad']?></td>
            <td><?php echo ($row['fecha_desde_novedad'] . ' | ' . $row['fecha_hasta_novedad'])?></td>
            <td><?php echo $row['tipo_usuario']?></td>
            <td>
                <form action="/bajorosario-shopping/src/controllers/novedades/novedades_edit_delete.php" method="POST">
                    <button class="btn btn-outline-warning" type="submit" name="action" value="edit">Edit</button>
                    <button class="btn btn-outline-danger" type="submit" name="action" value="delete">Borrar</button>
                    <input type="hidden" name="cod_novedad" value="<?php echo $row['cod_novedad']?>">
                </form>
            </td>
            </tr>
        </tbody>

    <?php }?>

    </table>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <!-- New novedad form -->
    <div class="card" style="width: 40rem;">
        <div class="card-body">

            <form action="/bajorosario-shopping/src/controllers/novedades/novedad_new.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Texto Novedad</label>
                    <input type="text" name="texto_novedad" class="form-control" autofocus required>
                </div>

                <!-- Input Fecha Ini -->
                <div class="mb-3">
                    <label for="fechaInicio" class="form-label">Novedad Desde</label>
                    <input type="date" class="form-control" name="fecha_desde" required>
                </div>

                <!-- Input fecha Hasta -->
                <div class="mb-3">
                    <label for="fechaFin" class="form-label">Novedad Hasta</label>
                    <input type="date" class="form-control" name="fecha_hasta" required>
                </div>
                
                <!-- Input Categoria Cliente -->
                <div class="mb-3">
                    <label for="selectOpciones" class="form-label">Tipo de Usuario</label>
                    <select class="form-select" id="selectOpciones" name="tipo_usuario">
                        <option value="cliente">Cliente</option>
                        <option value="dueno de local">Dueño de Local</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" name="save_novedad">    

            </form>

        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</div>

</div>

<?php include ("../footer.html")?>

