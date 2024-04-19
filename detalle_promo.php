<?php
    include("b_db.php");
    include("views/header.php");

    // Obtener el código de promoción de la URL
    $cod_promo = $_GET['cod_promo'];

    // Consultar la base de datos para obtener detalles de la promoción según el código
    $query = "SELECT * FROM promociones WHERE cod_promo = '$cod_promo'";
    $result = mysqli_query($conn, $query);

    // Mostrar detalles de la promoción
    if ($row = mysqli_fetch_array($result)) { 
    ?>
        <div class="container p-4" >
            <div class="card" style="width: 18rem;">
                <div href="#" class="card-body">
                    <div style="display: flex; justify-content: space-between;">
                        <!-- Texto promo -->
                        <h5 class="card-title"><?php echo $row['texto_promo']?></h5>
                        <!-- Cliente Badge -->
                        <div>
                            <span class="badge text-bg-info"><?php echo $row['categoria_cliente']?></span>
                        </div>
                    </div>
                    <!-- Local -->
                    <h6 class="card-subtitle mb-2 text-body-secondary">
                        <a href="/CRUD/local/<?php echo $row['cod_local']; ?>">
                            Local: <?php echo $row['cod_local']?>
                        </a>
                    </h6>
                    <!-- Fecha -->
                    <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $row['fecha_hasta_promo']?></h6>
                    <!-- Codigo -->
                    <h6 class="card-subtitle mb-2 text-body-secondary">Codigo de promocion: XXXXX</h6>
                    <!-- Dias de la semana -->
                </div>
            </div>
        </div>

    <?php
    } else {
        // Manejar el caso en que no se encuentre la promoción
        echo "<p>La promoción no existe o no está disponible.</p>";
    }

    include("views/footer.html");
?>

