<?php
include("config/db.php");

$query = "SELECT * FROM locales";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($connection);
    exit();
} else {
    
}

mysqli_close($conn);

?>

<section class="sectionPromo p-4" style="max-width: 1200px; margin: 0 auto;">
    <div style="width: 14rem;">
                <h2 style="font-size: 2rem; font-weight: bold;">Tiendas</h2>
                <!-- <a href="" style="color: black">Ver todas las tiendas</a> -->
    </div>

    <div class="d-flex flex-wrap gap-2 justify-content-center">

        <?php while ($local = mysqli_fetch_assoc($result)) { ?>


            <a href="local/<?php echo $local['cod_local']?>">
                <div class="card p-2" style="width: 15rem;">
                    <img src="<?php echo $local['url_logo']?>" class="card-img-top" alt="Logo de <?php echo $local['nombre_local']?>">
                </div>
            </a>
            
        <?php } ?>
    </div>
</section>
