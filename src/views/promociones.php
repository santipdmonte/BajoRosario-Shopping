<?php 
include __DIR__ . "/header.php";

include "../controllers/promociones/get_promociones.php";

// Número de elementos por página
$elementos_por_pagina = 4;

// Determinar la página actual a partir de la URL
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina_actual = max(1, $pagina_actual);

// Obtener el total de promociones para calcular el número total de páginas
$total_promociones = get_total_promociones_by_client_category();
$total_paginas = ceil($total_promociones / $elementos_por_pagina);

// Calcular el índice de inicio para la consulta SQL
$inicio = ($pagina_actual - 1) * $elementos_por_pagina;
$promociones = get_promociones_by_client_category_paginadas($inicio, $elementos_por_pagina);

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
    while($promo = mysqli_fetch_array($promociones)){ 
        
        // Itero por cada fila de promociones en la DB 
        include 'component_card.php';
    }?>

</div> 


<nav aria-label="Page navigation">
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?pagina=<?php echo max(1, $pagina_actual - 1); ?>">Previous</a>
        </li>

        <?php 
        for ($i = 1; $i <= $total_paginas; $i++) {
            $clase_activa = ($i == $pagina_actual) ? 'active' : '';
            echo '<li class="page-item ' . $clase_activa . '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
        }
        ?>

        <li class="page-item <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?pagina=<?php echo min($total_paginas, $pagina_actual + 1); ?>">Next</a>
        </li>
    </ul>
</nav>

    
<?php include __DIR__ . "/footer.html"?>

