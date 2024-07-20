<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
include "../../models/promocion.php";

$promociones = get_promociones_by_dueno($conn);

if ($promociones -> num_rows == 0) {
    // echo '<h3 class="text-center mt-5">No hay locales asociados a este dueño para crear promociones</h3>';
    // echo '<h5 class="text-center mt-5 grey">El administrador debe asociarte a un local</h5>';
    echo '<div class="alert alert-warning m-4 text-center" role="alert">No hay promociones disponibles</div>';
} else {
?>

<!-- TODO: Validar las fechas de las promo, hacer ver graficamente cuando una promo ya expiro -->

<div 
class="container p-4 section" 
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


    <table class="table table-striped table-hover shadow">

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


    // Itero por cada fila de promociones en la DB
    while($promocion = mysqli_fetch_array($promociones)){?>

        <tbody>
            <tr>
            <td><?php echo $promocion['texto_promo']?></td>
            <td><?php echo $promocion['cod_local']?></td>
            <td><?php echo ($promocion['fecha_desde_promo'] . ' | ' . $promocion['fecha_hasta_promo'])?></td>
            <td><?php echo $promocion['categoria_cliente']?></td>
            <td>
                <?php $dias_semana = json_decode($promocion['dias_semana'])?>
                    <div class="d-flex gap-1">
                        <?php include '../component_dias_semana.php'?>
                    </div>
            </td>
            <td>
                <form action="/bajorosario-shopping/src/controllers/promociones/promo_delete.php" method="POST">
                    <input type="hidden" name="cod_promo" value="<?php echo $promocion['cod_promo']?>">
                    <input type="hidden" name="source" value="dueno">
                    <button class="btn btn-outline-danger" type="submit" name="action" value="delete">Eliminar</button>
                </form>
            </td>
            </tr>
        </tbody>

    <?php } ?>

    </table>

</div>
    
<?php 
}
include ("../footer.php")?>

