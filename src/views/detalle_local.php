<?php
    include  "../../config/db.php";
    include __DIR__ . '/header.php';

    // Obtener el código de local de la URL
    $cod_local = $_GET['cod_local'];

    // Consultar la base de datos para obtener detalles del local según el código
    $query_local = "SELECT * FROM locales WHERE cod_local = '$cod_local'";
    $result_local = mysqli_fetch_array (mysqli_query($conn, $query_local)) ?>


    <?php
    if ($result_local) { 
    ?>

        <div>
            <h1><?php echo $result_local['nombre_local']?></h1>
            <p><?php echo $result_local['ubicacion_local']?></p>
            <p><?php echo $result_local['rubro_local']?></p>
            <img src="<?php echo $result_local['url_logo']?>" alt="">
        </div>

        <div>
            <h2 class="title">Promociones</h2>
            <div 
                class="container p-4" 
                style="
                display: flex; 
                flex-wrap: wrap; 
                gap: 10px; 
                justify-content: center; 
                align-items: center;">
        
        
                <?php   
                
                include("../../src/controllers/promociones/get_promociones.php");
                $promociones_by_client_category = get_promociones_by_client_category();
                            
                while($promo = mysqli_fetch_array($promociones_by_client_category)){ ?>
                
                    <!-- Itero por cada fila de promociones en la DB -->
                    <div class="card">
                        <div>
                            TODO: Ads Card Component
                        </div>
                    </div>
                    <!-- <div class="card" style="width: 18rem;">
                        <div href="#" class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <h5 class="card-title"><?php echo $promo['texto_promo']?></h5>
                                <div>
                                    <span class="badge text-bg-info"><?php echo $promo['categoria_cliente']?></span>
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <a href="local/<?php echo $promo['cod_local']; ?>">
                                    Local: <?php echo $promo['cod_local']?>
                                </a>
                            </h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $promo['fecha_hasta_promo']?></h6>

                            <?php if (isset($_SESSION['user'])){?>
                                <form action="src/controllers/promo_uso.php" method="POST">
                                    <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                                    <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                                    <button type="submit" class="btn btn-primary" name="use_promo">Obtener Promoción</button>
                                </form>
                            <?php }?>
                        </div> -->
                    </div>
                
                <?php } ?>
        
            </div>
        </div>

    <?php  
    } else {
        // Manejar el caso en que no se encuentre el local
        echo "<p>El local no existe o no está disponible.</p>";
    }

    include __DIR__ . '/footer.html';
?>
