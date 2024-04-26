<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
?>
<!-- TODO: Validar las fechas de las promo, hacer ver graficamente cuando una promo ya expiro -->
<div class="container pt-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    
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
    
    <div 
        class="container p-4" 
        style="
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
            overflow-x: auto;"
        >
    
        <table class="table table-striped table-hover shadow text-center" style="min-width: 900px;">
    
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
            $promociones_pendientes = mysqli_query($conn, $query);
    
            while($promocion = mysqli_fetch_array($promociones_pendientes)){?>
    
                <!-- Itero por cada fila de promociones en la DB -->
                <tbody>
                    <tr>
                    <td><?php echo $promocion['texto_promo']?></td>
                    <td><?php echo $promocion['cod_local']?></td>
                    <td><?php echo ($promocion['fecha_desde_promo'] . ' | ' . $promocion['fecha_hasta_promo'])?></td>
                    <td><?php echo $promocion['categoria_cliente']?></td>
                    <td>
                        <?php $dias_semana = json_decode($promocion['dias_semana'])?>
                            <div class="d-flex gap-1 justify-content-center">
                                <?php include '../component_dias_seman.php'?>
                            </div>
                    </td>
                    <td>
                        <form action="/bajorosario-shopping/src/controllers/promociones/promo_review.php" method="POST">
                            <button class="btn btn-outline-success" type="submit" name="action" value="approve">Aprobar</button>
                            <button class="btn btn-outline-danger" type="submit" name="action" value="deny">Denegar</button>
                            <input type="hidden" name="cod_promo" value="<?php echo $promocion['cod_promo']?>">
                        </form>
                    </td>
                    </tr>
                </tbody>
    
            <?php }?>
    
        </table>
    
    </div>
</div>
    
<?php include '../footer.html' ?>

