<?php 
include("src/models/promocion.php"); 
include("config/db.php");
?>

<link rel="stylesheet" href="cards.css">

<section class="sectionPromo" style="max-width: 1200px; margin: 0 auto;">

    <div class="racesWrapper p-4">
    <div class="races gap-4">
        <div style="width: 14rem;">
            <h2 style="font-size: 2rem; font-weight: bold;">Promociones</h2>
            <a href="" style="color: black">Ver todas las promociones</a>
        </div>

        <?php 
        $promociones_by_client_category = get_promociones_by_client_category($conn);
        $contador = 0;

        
        while($promo = mysqli_fetch_array($promociones_by_client_category)){ 
            
            // Itero por cada fila de promociones en la DB 
            include 'component_card.php';
        } ?>     

        <div class="d-md-block d-none" style="width: 25rem;">
        </div>
        
    </div>
    </div>
    
</section>

<div style="height: 100vh; background-color: blueviolet;"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
<script src="cards.js"></script>



