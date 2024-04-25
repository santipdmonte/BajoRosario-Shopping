<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
?>

<!-- TODO: Validar las fechas de las promo, hacer ver graficamente cuando una promo ya expiro -->

<div 
    class="container p-4" 
    style="
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center;"
    >

    <?php
        $tag = 'deleted';
        if (isset($_SESSION[$tag ]) && $_SESSION[$tag ]) {
                    echo '<div class="alert alert-danger" role="alert">Promocion eliminada</div>';
                    unset($_SESSION[$tag ]);
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
    $query = "
    SELECT * 
    FROM promociones 
    INNER JOIN locales ON promociones.cod_local = locales.cod_local
    WHERE estado_promo = 'aprobada'
        AND cod_usuario = " . $_SESSION['cod_usuario'] .
    " ORDER BY fecha_hasta_promo DESC";
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
                <form action="/bajorosario-shopping/src/controllers/promociones/promo_delete.php" method="POST">
                    <input type="hidden" name="cod_promo" value="<?php echo $row['cod_promo']?>">
                    <input type="hidden" name="source" value="dueno">
                    <button class="btn btn-outline-danger" type="submit" name="action" value="delete">Eliminar</button>
                </form>
            </td>
            </tr>
        </tbody>

    <?php }?>

    </table>

</div>
    
<?php include ("../footer.html")?>

