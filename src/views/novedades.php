<?php 
include __DIR__ . "/header.php";
?>

<!-- TODO: Mostar solo las promo a la fecha y validar el tipo de cliente -->
 <!-- chequear la columna de estado para novedades, no tiene sentido si valida por fecha-->

<section class="section">
    <h2 class="title"> Novedades </h2>
    
    <?php
        // Verificar si la variable de sesión está establecida para mostrar el toast
        if (isset($_SESSION['deleted']) && $_SESSION['deleted']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success" role="alert"> La promoción se elimino con éxito </div>';
            unset($_SESSION['deleted']);
        }
        if (isset($_SESSION['failed']) && $_SESSION['failed']) {
            // Si la promoción no se pudo guardar, muestra el mensaje
            echo '<div class="alert alert-danger" role="alert"> Error al eliminar la promoción</div>';
            unset($_SESSION['failed']);
        }
        ?>
    
    <div 
        class="container p-4" 
        style="
        display: flex; 
        flex-wrap: wrap; 
        gap: 10px; 
        justify-content: center; 
        align-items: center;">
        
        <?php
        include "../controllers/novedades/get_novedades.php";
        $result = get_novedades_by_user();

        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) { ?>
                <!-- Itero por cada fila de promociones en la DB -->
                <div class="card" style="width: 18rem;">
                    <div href="#" class="card-body">
                        <h5 class="card-title"><?php echo $row['texto_novedad']?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $row['fecha_hasta_novedad']?></h6>
                    </div>
                </div>
            <?php }
        } else { ?>
            <!-- Mostrar mensaje si no hay novedades -->
            <div class="alert alert-danger" role="alert" style="font-weight: bold; width: 70%; text-align: center;font-size: 1.5em; color:black;">
                No hay novedades por hoy.
            </div>
        <?php } ?>

    
    
    </div>
</section>
    
<?php include __DIR__ . "/footer.html"?>

