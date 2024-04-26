<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
include "../../controllers/promociones/get_promociones.php";

$promociones = get_promociones_by_dueno();
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


    while($promocion = mysqli_fetch_array($promociones)){?>

        <!-- Itero por cada fila de promociones en la DB -->
        <tbody>
            <tr>
            <td><?php echo $promocion['texto_promo']?></td>
            <td><?php echo $promocion['cod_local']?></td>
            <td><?php echo ($promocion['fecha_desde_promo'] . ' | ' . $promocion['fecha_hasta_promo'])?></td>
            <td><?php echo $promocion['categoria_cliente']?></td>
            <td>
                <?php $dias_semana = json_decode($promocion['dias_semana'])?>
                    <div class="d-flex gap-1">
                        <?php include '../component_dias_seman.php'?>
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

    <?php }?>

    </table>

</div>
    
<?php include ("../footer.html")?>

