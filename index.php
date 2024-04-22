<?php include("b_db.php"); ?>

<?php include("views/header.php")?>

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
    include("b_get_promociones.php");
    $promociones_by_client_category = get_promociones_by_client_category();

    while($promo = mysqli_fetch_array($promociones_by_client_category)){ ?>
        
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

                <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $promo['fecha_hasta_promo']?></h6>

                <?php $dias_semana = json_decode($promo['dias_semana']); ?>
                <div class="d-flex gap-1">
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[0]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">L</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[1]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">M</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[2]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">M</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[3]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">J</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[4]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">V</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[5]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">S</p>
                    <p class="rounded d-flex justify-content-center <?php echo $dias_semana[6]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">D</p>                                   
                </div>

                <?php if (isset($_SESSION['user'])){?>
                    <form action="b_promo_uso.php" method="POST">
                        <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                        <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                        <button type="submit" class="btn btn-primary w-100" name="use_promo">Obtener Promoción</button>
                    </form>
                <?php }?>

            </div>
        </div>
    <?php }?>


</div>
    
<?php include("views/footer.html")?>

