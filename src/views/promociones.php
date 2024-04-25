<?php 
include __DIR__ . "/header.php";
?>

<!-- TODO: Mostar solo las promo a la fecha y validar el tipo de cliente -->

<h2 class="title"> Promociones </h2>

<div 
    class="container p-4" 
    style="
    display: flex; 
    flex-wrap: wrap; 
    gap: 10px; 
    justify-content: center; 
    align-items: center;">
    
    <?php
    include "../controllers/promociones/get_promociones.php";
    $promociones = get_promociones_by_client_category();
    
    while($promo = mysqli_fetch_array($promociones)){ 
        
        // Itero por cada fila de promociones en la DB 
        include 'component_card.php';
    }?>


</div>
    
<?php include __DIR__ . "/footer.html"?>

