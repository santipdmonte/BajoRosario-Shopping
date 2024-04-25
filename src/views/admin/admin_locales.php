<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <?php
        // Verificar si la variable de sesión está establecida para mostrar el toast
        if (isset($_SESSION['saved']) && $_SESSION['saved']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success" role="alert"> El local se guardo con éxito </div>';
            unset($_SESSION['saved']);
        }
        if (isset($_SESSION['deleted']) && $_SESSION['deleted']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success" role="alert"> El local se elimino con éxito </div>';
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
        Nuevo Local
    </button>

    <!-- New local form -->
    <div class="card" style="width: 40rem;" hidden>
        <div class="card-body">

            <form action="/bajorosario-shopping/src/controllers/locales/local_new.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Texto -->


                <input type="submit" class="btn btn-primary" name="save_local">    

            </form>

        </div>
    </div>

    <!-- List Locales -->
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
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Rubro</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>

            <?php 
            // TODO: filtrar por fecha
            $query = "SELECT * FROM locales";
            $result = mysqli_query($conn, $query); 

            while($row = mysqli_fetch_array($result)){ ?>

                <!-- Itero por cada fila de promociones en la DB -->
                <tbody>
                    <tr>
                    <td><?php echo $row['cod_local']?></td>
                    <td><?php echo ($row['nombre_local'])?></td>
                    <td><?php echo $row['ubicacion_local']?></td>
                    <td><?php echo $row['rubro_local']?></td>
                    <td><?php echo $row['cod_usuario']?></td>
                    <td>
                        <form action="/bajorosario-shopping/src/controllers/locales/local_edit_delete.php" method="POST">
                            <button class="btn btn-outline-warning" type="submit" name="action" value="edit">Edit</button>
                            <button class="btn btn-outline-danger" type="submit" name="action" value="delete">Borrar</button>
                            <input type="hidden" name="cod_local" value="<?php echo $row['cod_local']?>">
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
                        <!-- New local form -->
                        <div class="card" style="width: 40rem;">
                            <div class="card-body">
                                <form action="/bajorosario-shopping/src/controllers/locales/local_new.php" method="POST">

                                    <!-- TODO: Validacion de inputs -->

                                    <!-- Input Nopmbre -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nombre Local</label>
                                        <input type="text" name="nombre_local" class="form-control" autofocus required>
                                    </div>

                                    <!-- Input Ubicacion -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ubicacion</label>
                                        <input type="text" name="ubicacion_local" class="form-control" required>
                                    </div>

                                    <!-- Input Rubro -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Rubro</label>
                                        <input type="text" name="rubro_local" class="form-control" required>
                                    </div>

                                    <!-- Input usuario -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario</label>
                                        <input type="text" name="cod_usuario" class="form-control" required>
                                    </div>

                                    <!-- <input type="text" name="cod_usuario" value= <?php # $_SESSION['cod_usuario'] ?> > -->

                                    <input type="submit" class="btn btn-primary" name="save_local">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ("../footer.html")?>
