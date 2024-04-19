<?php include("b_db.php"); ?>

<?php include("views/header.php")?>

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
            <th scope="col">Promo</th>
            <th scope="col">Local</th>
            <th scope="col">Desde - Hasta</th>
            <th scope="col">Categoria</th>
            <th scope="col">Dias</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>

    <?php 
    $query = "SELECT * FROM promociones WHERE estado_promo = 'pendiente'";
    $result_tasks = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result_tasks)){?>

        <!-- Itero por cada fila de promociones en la DB -->
        <tbody>
            <tr>
            <td><?php echo $row['texto_promo']?></td>
            <td><?php echo $row['cod_local']?></td>
            <td><?php echo ($row['fecha_desde_promo'] . ' | ' . $row['fecha_hasta_promo'])?></td>
            <td><?php echo $row['categoria_cliente']?></td>
            <td><?php echo $row['dias_semana']?></td>
            <td>
                <form action="b_promo_review.php" method="POST">
                    <button class="btn btn-outline-success" type="submit" name="action" value="approve">Aprobar</button>
                    <button class="btn btn-outline-danger" type="submit" name="action" value="deny">Denegar</button>
                    <input type="hidden" name="cod_promo" value="<?php echo $row['cod_promo']?>">
                </form>
            </td>
            </tr>
        </tbody>

    <?php }?>

    </table>

</div>
    
<?php include("views/footer.html")?>

