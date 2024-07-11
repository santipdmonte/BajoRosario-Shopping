<?php $dias_semana = json_decode($promo['dias_semana']); ?>

<div>
    <div class="card" style="width: 15rem;">
        <img src="<?php echo $promo['url_logo']?>" class="card-img-top" alt="Logo de <?php echo $promo['nombre_local']?>">
        <div href="#" class="card-body">

            <div style="display: flex; justify-content: space-between;">
                <h5 class="card-title"><?php echo $promo['texto_promo']?></h5>
                <div>
                    <span class="badge rounded-pill text-bg-info"><?php echo $promo['categoria_cliente']?></span>
                </div>
            </div>

            <h6 class="card-subtitle mb-2 text-body-secondary">
                <a href="local/<?php echo $promo['cod_local']; ?>" style="color: black">
                    <?php echo $promo['nombre_local']?>
                </a>
            </h6>

            <h6 class="card-subtitle mb-2 text-body-secondary">
                Hasta el <?php echo $promo['fecha_hasta_promo']?>
            </h6>

            <div class="d-flex gap-1">
                <?php include 'component_dias_semana.php';  ?>                              
            </div>

            <?php if (isset($_SESSION['user'])){?>
                <form action="/bajorosario-shopping/src/controllers/promociones/promo_uso.php" method="POST">
                    <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                    <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                    <button type="submit" class="btn btn-primary w-100" name="use_promo">Obtener Promoción</button>
                </form>
            <?php } else {?>
                <form action="/bajorosario-shopping/inicio_sesion" method="POST">
                    <button type="submit" class="btn btn-secondary w-100" name="use_promo_no_sesion">Obtener Promoción</button>
                </form>
            <?php } ?>

        </div>
    </div>
</div>