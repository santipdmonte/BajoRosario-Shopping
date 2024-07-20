<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";

$categoryQuery = "SELECT * FROM cateogrias_locales";
$categoryResult = mysqli_query($conn, $categoryQuery);

$userQuery = "SELECT * FROM usuarios WHERE tipo_usuario = 'dueno de local'";
$userResult = mysqli_query($conn, $userQuery);



?>

<div class="container pt-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <?php
        if (isset($_SESSION['success']) && $_SESSION['success']) {
            echo '<div class="alert alert-success" role="alert">'. $_SESSION['success'] .'</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error']) && $_SESSION['error']) {
            echo '<div class="alert alert-error" role="alert">'. $_SESSION['error'] .'</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['warning']) && $_SESSION['warning']) {
            echo '<div class="alert alert-warning" role="alert">'. $_SESSION['warning'] .'</div>';
            unset($_SESSION['warning']);
        }
    ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nuevo Local
    </button>

    <!-- List Locales -->
    <div 
        class="container p-4" 
        style="
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center;
        overflow-x: auto;">

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
            if (isset($_SESSION['warning']) && $_SESSION['warning']) {
                echo '<div class="alert alert-warning" role="alert">'. $_SESSION['warning'] .'</div>';
                unset($_SESSION['warning']);
            }
        ?>

        <table class="table table-striped table-hover shadow text-center" style="min-width: 750px;">
 
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
            $query = "SELECT * FROM locales";
            $result = mysqli_query($conn, $query); 
            $conn->close();

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



        <!-- Input Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Local</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- New local form -->
                        <div class="card">
                            <div class="card-body">
                                <form action="/bajorosario-shopping/src/controllers/locales/local_new.php" method="POST" enctype="multipart/form-data">

                                    <!-- Input Nopmbre -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nombre Local</label>
                                        <input type="text" name="nombre_local" class="form-control" autofocus required>
                                    </div>

                                    <!-- Input Logo Local -->
                                    <div>
                                        <label for="">Logo Local</label>
                                        <input type="file" name="imagen_local" class="form-control">
                                    </div>

                                    <!-- Input Ubicacion -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ubicacion</label>
                                        <input type="text" name="ubicacion_local" class="form-control" required>
                                    </div>

                                    <!-- Input Rubro -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Rubro</label>
                                        <select name="rubro_local" class="form-control" required>
                                            <?php
                                            echo '<option disabled selected>Seleccionar Categoria</option>';
                                            while ($categoryRow = mysqli_fetch_array($categoryResult)) {
                                                echo '<option value="' . $categoryRow['categoria'] . '">'. $categoryRow['categoria'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Input usuario -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario</label>
                                        <!-- <input type="text" name="cod_usuario" class="form-control" required> -->
                                        <select name="cod_usuario" class="form-control" required>
                                            <?php
                                            echo '<option disabled selected>Seleccionar Usuario</option>';
                                            while ($userRow = mysqli_fetch_array($userResult)) {
                                                echo '<option value="' . $userRow['cod_usuario'] . '"> [' . $userRow['cod_usuario'] . '] - ' . $userRow['nombre_usuario'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- <input type="text" name="cod_usuario" value= <?php # $_SESSION['cod_usuario'] ?> > -->

                                    <input type="submit" class="btn btn-primary" name="save_local">  

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php include ("../footer.php")?>
