<?php include("b_db.php"); ?>

<?php include("views/header.php")?>

<!-- TODO: Validar las fechas de las promo, hacer ver graficamente cuando una promo ya expiro -->

<div 
    class="container p-4" 
    style="
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center;
    ">

    <?php 
    if (isset($_SESSION['review_approve']) && $_SESSION['review_approve']) {
        echo '<div class="alert alert-success" role="alert"> El usuario se aprobo con éxito </div>';
        unset($_SESSION['review_approve']);
    }
    if (isset($_SESSION['review_deny']) && $_SESSION['review_deny']) {
        echo '<div class="alert alert-success" role="alert"> El usuario se denego con éxito </div>';
        unset($_SESSION['review_deny']);
    }
    if (isset($_SESSION['review_failed']) && $_SESSION['review_failed']) {
        echo '<div class="alert alert-danger" role="alert"> Error al aprobar/denegar al usuario</div>';
        unset($_SESSION['review_saved']);
    }
    ?>

    <table class="table table-dark table-striped table-hover shadow">

    <thead>
        <tr>
            <th scope="col">Cod Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Accion</th>
        </tr>
    </thead>

    <?php 
    $query = "SELECT * FROM usuarios WHERE tipo_usuario = 'dueno de local' AND estado_usuario = 'pendiente'";
    $result_tasks = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result_tasks)){?>

        <!-- Itero por cada fila de promociones en la DB -->
        <tbody>
            <tr>
            <td><?php echo $row['cod_usuario']?></td>
            <td><?php echo $row['nombre_usuario']?></td>
            <td><?php echo ($row['email'])?></td>
            <td>
                <form action="b_dueno_review.php" method="POST">
                    <button class="btn btn-outline-success" type="submit" name="action" value="approve">Aprobar</button>
                    <button class="btn btn-outline-danger" type="submit" name="action" value="deny">Denegar</button>
                    <input type="hidden" name="cod_usuario" value="<?php echo $row['cod_usuario']?>">
                </form>
            </td>
            </tr>
        </tbody>

    <?php }?>

    </table>

</div>
    
<?php include("views/footer.html")?>

