<?php
    include  "../../config/db.php";
    include __DIR__ . '/header.php';
    include("../../src/models/promocion.php");

    // Obtener el código de local de la URL
    $cod_local = $_GET['cod_local'];

    // Consultar la base de datos para obtener detalles del local según el código
    $query_local = "SELECT * FROM locales WHERE cod_local = '$cod_local'";
    $result_local = mysqli_fetch_array (mysqli_query($conn, $query_local)); 
    
    $promociones_by_client_category = get_promociones_by_client_category($conn);

?>

    <?php if ($result_local) { ?>

        <div class="d-flex justify-content-center" style="width: 100%;">
            <div style="width: 80%;">

                <div class="text-center">
                    <h1 style="font-family: Times New Roman;"><?php echo $result_local['nombre_local']?></h1>
                </div>
                <hr/>

                <div class="text-left">
                    <p class="fs-4"><strong>Ubicación:</strong> <?php echo $result_local['ubicacion_local']?></p>
                </div>

                <div class="text-left">
                    <p class="fs-4"><strong>Rubro:</strong> <?php echo $result_local['rubro_local']?></p>
                </div>

                <div class="text-center">
                    <img src="<?php echo $result_local['url_logo']?>" alt="Logo del local" style="max-width: 100%;">
                </div>

            </div>
            <hr/>
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
                    align-items: center;"
                >
                
                <?php while($promo = mysqli_fetch_array($promociones_by_client_category)){ ?>
                    
                    <!-- Itero por cada fila de promociones en la DB -->
                    <div class="card" style="width: 18rem;">
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

                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                Hasta el <?php echo $promo['fecha_hasta_promo']?>
                            </h6>

                            <?php if (isset($_SESSION['user'])){?>
                                <form action="src/controllers/promo_uso.php" method="POST">
                                    <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                                    <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                                    <button type="submit" class="btn btn-primary" name="use_promo">Obtener Promoción</button>
                                </form>
                            <?php }?>

                        </div> 
                    </div>
                <?php } ?>
            </div>
        </div>

    <?php } else {?>

        <!--Manejar el caso en que no se encuentre el local-->
        <div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert" style="width: 50%; margin: 0 auto; text-align: center;">
            <h2 class="text-dark">El local no existe o no está disponible.</h2>
        </div>

    <?php } ?>

<?php include __DIR__ . '/footer.html'; ?>
