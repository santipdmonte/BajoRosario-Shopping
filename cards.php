<link rel="stylesheet" href="cards.css">

<section class="sectionPromo" style="max-width: 1200px;">

    <div class="racesWrapper p-4">
    <div class="races gap-4">
        <div style="width: 350px;">
            <h2 style="font-size: 2rem; font-weight: bold;">Promociones</h2>
            <a href="" style="color: black">Ver todas las promociones</a>
        </div>

        <?php 
        include("b_get_promociones.php");
        $promociones_by_client_category = get_promociones_by_client_category();
        $contador = 0;

        while($promo = mysqli_fetch_array($promociones_by_client_category)){ ?>
            
            <!-- Itero por cada fila de promociones en la DB -->
            <div>

                <div class="card" style="width: 30rem;">
                    <img src="/bajorosario-shopping/assets/img/hero_1.webp" class="card-img-top" alt="...">
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
            </div>
        <?php 

        // Si hay mas de 4 promociones, muestro un boton para ver mas
        $contador++;
        if ($contador >= 4) {
            break;
            ?>
            <div class="flex text-center m-auto">
                <a class="card btn bg-secondary shadow flex" style="width: 10rem; height: 10rem;">
                    <h5>Ver mas <br>Promociones</h5>            
                </a>
            </div>
        <?php } }?>

        <div class="flex text-center m-auto">
                <a class="card btn bg-secondary shadow flex" style="width: 10rem; height: 10rem;">
                    <h5>Ver mas <br>Promociones</h5>            
                </a>
            </div>       

        <div style="width: 20rem;">
        </div>
        
    </div>
    </div>
    
</section>

<div style="height: 100vh; background-color: blueviolet;"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
<script src="cards.js"></script>



