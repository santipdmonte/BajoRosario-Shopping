<?php
    include __DIR__ . '/header.php';
    include '../controllers/validate_user_access.php';
    include  "../../config/db.php";


    // Obtener el código de promoción de la URL
    $cod_promo = $_GET['cod_promo'];

    // Consultar la base de datos para obtener detalles de la promoción según el código
    $query = "SELECT * FROM promociones WHERE cod_promo = '$cod_promo'";
    $result = mysqli_query($conn, $query);
    $promo = mysqli_fetch_assoc($result);

?>

<div class="container p-4" >
        
    <a class='m-2' href="javascript:history.back()">< Volver</a>

    <?php
    // Si no se encuentra la promoción, mostrar un mensaje de error
    if (!$promo){
        echo "<p>La promoción no existe o no está disponible.</p>";
        include __DIR__ . '/footer.php';
        exit();
    }

    // Validar acceso a la promoción
    if (!validate_category_access($conn, $promo)){
        if (isset($_SESSION['user'])){
            echo "<p>No tienes acceso a esta promoción. <a href='/bajorosario-shopping/'>Volver al inicio</a></p>";
            echo "<p>Esta promocion esta disponible para clientes con categoria '". ucfirst($promo['categoria_cliente']) ."'.";
        } else {
            echo "<p>Para acceder a las promociones debes <a href='/bajorosario-shopping/inicio_sesion'>Iniciar Sesion</a></p>";
        }
        include __DIR__ . '/footer.php';
        exit();
    } 
    ?>

    <div class="card" style="width: 18rem;">
        <div href="#" class="card-body">

            <div style="display: flex; justify-content: space-between;">
                <!-- Texto promo -->
                <h5 class="card-title"><?php echo $promo['texto_promo']?></h5>
                <!-- Cliente Badge -->
                <div>
                    <span class="badge text-bg-info"><?php echo $promo['categoria_cliente']?></span>
                </div>
            </div>

            <!-- Local -->
            <h6 class="card-subtitle mb-2 text-body-secondary">
                <a href="/bajorosario-shopping/local/<?php echo $promo['cod_local']; ?>">
                    Local: <?php echo $promo['cod_local']?>
                </a>
            </h6>

            <!-- Fecha -->
            <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $promo['fecha_hasta_promo']?></h6>

            <!-- Codigo -->
            <h6 class="card-subtitle mb-2 text-body-secondary">Codigo de promocion: <?php echo $promo['clave_promo'] ?></h6>
            
            <!-- Dias de la semana -->
        </div>
    </div>
</div>
    
<?php

include __DIR__ . '/footer.php';
?>

