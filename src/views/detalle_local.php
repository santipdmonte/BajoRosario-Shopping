<?php
    include __DIR__ . '/header.php';
    include("../../src/models/promocion.php");
    include("../controllers/validate_user_access.php");
    
    // Obtener el código de local de la URL
    $cod_local = $_GET['cod_local'];
    
    // Consultar la base de datos para obtener detalles del local según el código
    include  "../../config/db.php";
    $query_local = "SELECT * FROM locales WHERE cod_local = '$cod_local'";
    $result_local = mysqli_fetch_array (mysqli_query($conn, $query_local)); 
    
    $promociones_by_client_store = get_promociones_by_client_store($conn, $cod_local);

?>

    <?php if ($result_local) { ?>

        <div 
            class="container p-4" 
            style="
            display: flex; 
            flex-wrap: wrap; 
            gap: 10px; 
            justify-content: center; 
            align-items: center;">
        
            <div class="d-flex justify-content-center" style="width: 100%;">
                <div style="width: 100%;">

                    <div class="text-center">
                        <h1 style="font-family: Times New Roman;"><?php echo $result_local['nombre_local']?></h1>
                    </div>
                    <hr/>

                    <div class="d-flex gap-4">
                        <div class="text-left">
                            <img src="<?php echo $result_local['url_logo']?>" alt="Logo del local" style="max-width: 100%;">
                        </div>
                        <div>
                            <div class="text-left">
                                <p class="fs-4"><strong>Ubicación:</strong> <?php echo $result_local['ubicacion_local']?></p>
                            </div>
        
                            <div class="text-left">
                                <p class="fs-4"><strong>Rubro:</strong> <?php echo $result_local['rubro_local']?></p>
                            </div>
                        </div>
                    </div>

                </div>
                <hr/>
            </div>


            <div class="w-80">
                <h2 class="title text-center">Promociones</h2>
                <div 
                    class="container p-4" 
                    style="
                        display: flex; 
                        flex-wrap: wrap; 
                        gap: 10px; 
                        justify-content: center; 
                        align-items: center;"
                    >

                    <?php if ($promociones_by_client_store -> num_rows == 0) {
                        echo "<p>No hay promociones disponibles para este local.</p>";
                    } else {
                    while($promo = mysqli_fetch_array($promociones_by_client_store)){ ?>
                        
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
                                    Hasta el <?php echo $promo['fecha_hasta_promo']?>
                                </h6>

                                <?php if (isset($_SESSION['user'])){?>
                                    <form action="/bajorosario-shopping/src/controllers/promociones/promo_uso.php" method="POST">
                                        <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                                        <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                                        <?php 
                                        echo validate_category_access($conn, $promo) ? 
                                            '<button type="submit" class="btn btn-primary w-100" name="use_promo">Obtener Promoción</button>' : 
                                            '<button type="submit" class="btn btn-secondary w-100 disabled" name="use_promo">Obtener Promoción</button>';  
                                        ?>
                                    </form>
                                <?php } else {?>
                                    <form action="/bajorosario-shopping/inicio_sesion" method="POST">
                                        <button type="submit" class="btn btn-secondary w-100" name="use_promo_no_sesion">Obtener Promoción</button>
                                    </form>
                                <?php } ?>

                            </div> 
                        </div>
                    <?php }} ?>
                </div>
            </div>
        </div>


    <?php } else {?>

        <!--Manejar el caso en que no se encuentre el local-->
        <div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert" style="width: 50%; margin: 0 auto; text-align: center;">
            <h2 class="text-dark">El local no existe o no está disponible.</h2>
        </div>

    <?php } ?>

<?php include __DIR__ . '/footer.php'; ?>
<?php $conn->close();?>
